const terbilangBilanganBulat = (value) => {
	let _value;

    const lastEleven = {
        "0": " ", "1": "Satu", "2": "Dua", 3: "Tiga", 4: "Empat", "5": "Lima", "6": "Enam", "7": "Tujuh", "8": "Delapan", "9": "Sembilan", "10": "Sepuluh", "11": "Sebelas"
    };
    
    Object.entries(lastEleven).forEach((obj, val) => {  
        if (parseInt(value) == parseInt(val)) {
            _value = lastEleven[val] + ' ';
            return;
        }
    })

    if (_value) {
        return _value;
    } 

    switch (true) {
        case value >= 11 && value<=19 : {
            _value = terbilangBilanganBulat(value % 10) + 'Belas ';
            break;
        }
        case value >= 20 && value <= 99 : {
            _value = terbilangBilanganBulat(Math.floor(value / 10)) + 'Puluh ' + terbilangBilanganBulat(value % 10);
            break;
        }
        case value >= 100 && value <= 199 : {
            _value = 'Seratus ' + terbilangBilanganBulat(value-100);
            break;
        }
        case value >= 200 && value <= 999 : {
            _value = terbilangBilanganBulat(Math.floor(value/100)) + 'Ratus ' + terbilangBilanganBulat(value % 100);
            break;
        }
        case value >= 1000 && value <= 1999 : {
            _value = 'Seribu ' + terbilangBilanganBulat(value-1000);
            break;
        }
        case value >= 2000 && value <= 999999: {
            _value = terbilangBilanganBulat(Math.floor(value/1000)) + 'Ribu ' + terbilangBilanganBulat(value % 1000);
             break; 
        }
        case value >= 1000000 && value <= 999999999: {
            _value = terbilangBilanganBulat(Math.floor(value/1000000)) + 'Juta ' + terbilangBilanganBulat(value%1000000);
            break;    
        }
        case value >= 100000000 && value <= 999999999999 : {
            _value = terbilangBilanganBulat(Math.floor(value/1000000000)) + 'Milyar ' + terbilangBilanganBulat(value%1000000000);
            break;
        }
        case value >= 1000000000000 : {
            _value = terbilangBilanganBulat(Math.floor(value/1000000000000)) + 'Triliun ' + terbilangBilanganBulat(value%1000000000000);
            break;
        }
        default: break;
    }
    return _value;
}

const terbilangBilanganDesimal = (value) => {
    return value.length == 0 ? '' : 
        value.split('0').join('Nol ')
            .split('1').join('Satu ')
            .split('2').join('Dua ')
            .split('3').join('Tiga ')
            .split('4').join('Empat ')
            .split('5').join('Lima ')
            .split('6').join('Enam ')
            .split('7').join('Tujuh ')
            .split('8').join('Delapan ')
            .split('9').join('Sembilan ');
}

const Terbilang = (value) => {
    let _value;
    let minus = '';
    let sub = '';
    let subkoma = '';
    let p1 = '';
    let p2 = '';
    let koma = 'Koma ';

    if (value > 999999999999999999) {
        return 'Limit';
    }

    if (value == 0) {
        return 'Nol ';
    }
    
    if (value < 0){
        minus = 'Minus ';
    }

    _value = Math.abs(value);
    tmp = value.toString().split('.');
    p1 = tmp[0];

    if (tmp.length > 1) {		
        p2 = tmp[1];
    }

    _value = parseFloat(p1);
    sub = terbilangBilanganBulat(_value);
    subkoma = terbilangBilanganDesimal(p2);

    if (subkoma === '') {
        koma = '';
    }

    sub = minus + sub.replace('  ',' ') + koma + subkoma.replace('  ',' ');
    return sub.replace('  ', ' ');
}