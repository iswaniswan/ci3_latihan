<?php defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require 'BaseController.php';
class Laporan extends BaseController {

	protected $menu = 'laporan';

	public function __construct()
	{
		parent::__construct();
		$this->setActiveMenu($this->menu);

		//load model
		$this->load->model('ModelBarang');
		$this->load->model('ModelSupplier');
		$this->load->model('ModelPembelian');
		$this->load->model('ModelPembelianDetail');
		$this->load->model('ModelLaporan');
	}

	public function index()
	{
		$allBarang = $this->ModelBarang->getAll();
		$allSupplier = $this->ModelSupplier->getAll();

		$this->render('laporan/index', [
			'allBarang' => $allBarang,
			'allSupplier' => $allSupplier
		]);
	}

	public function generate()
	{
		$post = $this->input->post();
		if (!@$post) {
			$this->session->set_flashdata('danger', 'Request gagal.');
			redirect ('laporan/index');
		}

		$params = [
			'tanggal_mulai' => @$post['tanggal_mulai'],
			'tanggal_akhir' => @$post['tanggal_akhir'],
			'id_supplier' => @$post['id_supplier'],
		];
		$allData = $this->ModelLaporan->getAll($params);

		if (@$post['export_excel']) {
//			echo '<pre>'; var_dump($allData); echo '</pre>';
			$supplier = '';
			if (intval($params['id_supplier']) > 0){
				$getSupplier = $this->getSupplier(['id_supplier' => $params['id_supplier']]);
				$supplier = $getSupplier['nama'] . '_';
			}
			$filename = 'Laporan_pembelian_' . $supplier .$params['tanggal_mulai'].'-'.$params['tanggal_akhir'] . '.xlsx';
			return $this->exportExcel($allData, $filename);
		}

		$this->render('laporan/read', [
			'allData' => $allData,
			'post' => $post
		]);
	}

	public function exportExcel($allData=[], $filename=null)
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', "NO");
		$sheet->setCellValue('B1', "NAMA SUPPLIER");
		$sheet->setCellValue('C1', "TANGGAL");
		$sheet->setCellValue('D1', "NO. DOKUMEN");
		$sheet->setCellValue('E1', "KODE");
		$sheet->setCellValue('F1', "NAMA");
		$sheet->setCellValue('G1', "QUANTITY");
		$sheet->setCellValue('H1', "HARGA SATUAN");
		$sheet->setCellValue('I1', "SUBTOTAL");

		$no=1;
		$row=2;
		foreach ($allData as $data) {
			$sheet->setCellValue('A'.$row, $no++);
			$sheet->setCellValue('B'.$row, $data['nama_supplier']);
			$sheet->setCellValue('C'.$row, $data['tanggal']);
			$sheet->setCellValue('D'.$row, $data['no_dokumen']);
			$sheet->setCellValue('E'.$row, $data['kode_barang']);
			$sheet->setCellValue('F'.$row, $data['nama_barang']);
			$sheet->setCellValue('G'.$row, $data['qty']);
			$sheet->setCellValue('H'.$row, 'Rp. ' . number_format($data['harga_satuan'], 2, ".", ","));
			$sheet->setCellValue('I'.$row, 'Rp. ' . number_format($data['subtotal'], 2, ".", ",") );
			$row++;
		}

		$sheet->getDefaultRowDimension()->setRowHeight(-1);
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		$sheet->setTitle("Laporan Data Siswa");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		if ($filename == null) {
			$filename = "Laporan_pembelian_.xlsx";
		}

		header('Content-Disposition: attachment; filename="'. $filename . '"');
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	private function getSupplier($params=[])
	{
		$this->load->model('ModelSupplier');
		$allSupplier = $this->ModelSupplier->getAll();

		if (@$params['id_supplier'] != null) {
			foreach ($allSupplier as $supplier) {
				if ($supplier['id'] == $params['id_supplier']) {
					return $supplier;
				}
			}
		}

		return $allSupplier;
	}

}
