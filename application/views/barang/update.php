<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Form Update Barang
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= site_url('barang/update') ?>">
                    <div class="mb-3">
                        <label class="form-label">Kode</label>
                        <input type="text" class="form-control" value="<?= $data['kode'] ?>" name="kode">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" value="<?= $data['nama'] ?>" name="nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="text" class="form-control currency-input" value="Rp. <?= number_format($data['harga'], 2, ".", ",") ?>" name="harga">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <?php $checked = $data['status'] == 't' ? 'checked' : ''; ?>
                        <input type="checkbox" class="form-check-input mt-1" name="status" <?= $checked ?> data-id="<?= $data['id'] ?>">
                    </div>
                    <input type="hidden" value="<?= $data['id'] ?>" name="id">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?= site_url('barang/index') ?>" class="btn btn-dark">
                        Kembali
                    </a> 
                </form>
            </div>
        </div>
    </div>
</div>

<!-- currency formatter -->
<script type="text/javascript">
function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur, prefix) {
  var input_val = input.val();

  if (input_val === "") { return; }
  var original_len = input_val.length;
  var caret_pos = input.prop("selectionStart");
  if (input_val.indexOf(".") >= 0) {
    var decimal_pos = input_val.indexOf(".");
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);
    left_side = formatNumber(left_side);
    right_side = formatNumber(right_side);
    if (blur === "blur") {
      right_side += "00";
    }
    right_side = right_side.substring(0, 2);
    input_val = left_side + "." + right_side;

  } else {
    input_val = formatNumber(input_val);
    input_val = input_val;
    if (blur === "blur") {
      input_val += ".00";
    }
  }

  if (prefix) {
    input_val = prefix + " " + input_val;
  }
  
  input.val(input_val);
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}
</script>

<script>
    $(document).ready(function() {
        
        $("input.currency-input").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() { 
                formatCurrency($(this), "blur", "Rp. ");
            }
        });
        
    })

</script>