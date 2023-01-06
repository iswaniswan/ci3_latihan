// format number 1000000 to 1,234,567
const FormatNumber = (n) => {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}
  
  
const FormatCurrency = (input, blur, prefix) => {
    var input_val = input.val();

    if (input_val === "") {
         return; 
    }
    
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");
    
    if (input_val.indexOf(".") >= 0) {
        var decimal_pos = input_val.indexOf(".");
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
        left_side = FormatNumber(left_side);
        right_side = FormatNumber(right_side);
        if (blur === "blur") {
            right_side += "00";
        }
        right_side = right_side.substring(0, 2);
        input_val = left_side + "." + right_side;
    } else {
        input_val = FormatNumber(input_val);
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