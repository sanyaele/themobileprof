$(document).ready(function(){
    $('#website').change(get_amount);
    $('.calc').click(get_amount);
    
    function get_amount() {
        // Amount comes with webhosting fee by default
        var amount = 0;

        // get values from FORM
        var website = $("select#website").val();

        if (website == 'standard'){ // User wants a standard informational website
            amount = amount + 100000;
        } else if (website == 'ecommerce'){ // User wants an ecommerce website
            amount = amount + 250000;
        } else { // Assume it is a blog 
            amount = amount + 50000;
        }

        if ($("input#webhosting[type=checkbox]").prop('checked')){
            amount = amount + 54000;
        }

        if ($("input#naira_payment[type=checkbox]").prop('checked')){
            amount = amount + 50000;
        }

        if ($("input#dollar_payment[type=checkbox]").prop('checked')){
            amount = amount + 50000;
        }

        var quarter = amount / 4;

        // Set Payment ids
        $("#cost_total").html("N" + amount.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        $("#cost_pay").html("N" + quarter.toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, "$1,"));
        $("input#amount").val(quarter);
    };
});