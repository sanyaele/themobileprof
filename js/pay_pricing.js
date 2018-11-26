$(document).ready(function(){
    $('.calc').click(get_amount);
    
    function get_amount() {
        // Amount comes with webhosting fee by default
        var amount = 0;


        if ($("input#naira_payment[type=checkbox]").prop('checked')){ //20% discount
            amount = amount + 40000;
        }

        if ($("input#dollar_payment[type=checkbox]").prop('checked')){ //20% discount
            amount = amount + 40000;
        }

        // Set Payment ids
        $("#cost_total").html("N" + amount.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        $("input#amount").val(amount);
    };
});