window.onload = function(){
    $.ajax({
        type: 'POST',
        async: false,
        url: 'http://currency/site/count-contr',
        dataType: 'json',
        success: function(data) {
            for (i=0;i <= data.length; i++ ) {
                $('.span-count-contr-' + data[i].login).html(data[i].counts);
            }
         }
    })
}

function conversionKursToSum(sum_from) {
    var rate_new = $('#auctions-rate').val();
    var sum_to = sum_from * rate_new;
    $('#auctions-sum_to').val(sum_to);
}

function conversionSumToKurs(sum_from) {
    var sum_to = $('#auctions-sum_to').val();
    var rate_new = sum_to / sum_from;
    $('#auctions-rate').val(rate_new);
}

function rateToSum() {
    var sum_from=$('#propositions-sum_from').val();
    var rate = $('#propositions-rate').val();
    var sum_to = sum_from * rate;
    $('#propositions-sum_to').val(sum_to);
}
function sumToRate() {
    var sum_from=$('#propositions-sum_from').val();
    var sum_to=$('#propositions-sum_to').val();
    var rate = sum_to/sum_from;
    $('#propositions-rate').val(rate);
}

function accept(id_prop, prop_user_id, id) {
    if (id == '0') {
        document.location.href = "http://currency/site/login";
    } else if (prop_user_id == id) {
            alert("Нельзя принять свое предложение!");
    } else {
        if (window.confirm("Принять предложение?")) {
            var url = "http://currency/auction/accept/" + id_prop;
            document.location.href = url;
        }
    }
}

function auction(id_prop, prop_user_id, id) {

    if (id == '0') {
        document.location.href = "http://currency/site/login";
    } else if (prop_user_id == id) {
        alert("Вы не можете торговаться с собой!");
    } else {
        if (window.confirm("Начать торг?")) {
           // alert ('data-target-auction-' + id_prop);
            $('#modal-auction').modal('show')
                .find('#modal-content-auction')
                .load($('#modal-btn-auction-' + id_prop).attr('data-target-auction-' + id_prop));
        }
    }
}

function bargain(id_auc){
    $('#modal-auction').modal('show')
        .find('#modal-content-auction')
        .load($('#modal-btn-auction-' + id_auc).attr('data-target-auction-' + id_auc));
}

function ok(id_prop, id_auc){
    if (window.confirm("Принять предложение?")) {
        var url = "http://currency/personal/accept/" + id_prop +"/"+ id_auc;
        document.location.href = url;
    }
}

function acc(id_prop, id_auc){
    if (window.confirm("Принять предложение?")) {
        var url = "http://currency/personal/acc/" + id_prop +"/"+ id_auc;
        document.location.href = url;
    }
}
function accProp(id_prop, id_auc){
    if (window.confirm("Принять предложение?")) {
        var url = "http://currency/personal/accprop/" + id_prop +"/"+ id_auc;
        document.location.href = url;
    }
}

function no_bargain(id_prop){
    if (window.confirm("Отменить торг?")) {
        var url = "http://currency/auction/no_bargain/"+id_prop;
        document.location.href = url;
    }
}

function no(id_prop){
    if (window.confirm("Отменить предложение?")) {
        var url = "http://currency/messages/"+id_prop;
        document.location.href = url;
    }
}


    $('#cur_from').change(function () {
        $.ajax({url:
            'site/rate',
            data:{'from':$('#cur_from').val(),'to':$('#cur_to').val()},
            type:'POST',
            success:function (res) {
                $('#rate').html(res);
            },
            error:function () {
                alert('Error!');
            }
        });
    });

$('#cur_to').change(function () {

    $.ajax({url:
        'site/rate',
        data:{'from':$('#cur_from').val(),'to':$('#cur_to').val()},
        type:'POST',
        success:function (res) {
            $('#rate').html(res);
        },
        error:function () {
            alert('Error!');
        }
    });
});

function setMsg(){

    $.ajax({
        type: 'POST',
        async: false,
        url: 'http://currency/personal/count',
        dataType: 'json',
        success: function(data) {
            $('#msg').html(data.all);
            $('#auction').html(data.barb);
            $('#admin').html(data.admin);
        }
    })
}

setInterval(setMsg,1000);

$('.eye').on('click',function () {
    $(".lorem").slideToggle(1000);
})

    $('#avg').on('click',function(){
       var z = $('#rate').html()
        $('.avg').val(z);
        rateToSum()
    });

function ChangeCurrencyFrom() {
    var cur_from = document.getElementById("cur_from").options.selectedIndex;
    var cur_to = document.getElementById("cur_to").options.selectedIndex;

    if (cur_from == cur_to && cur_from != 0) {
            alert('Вы не можите выбрать одинаковые валюты');
            document.getElementById("cur_to").options[cur_from].selected = false;
    }
}

function ChangeCurrencyTo() {
    var cur_from = document.getElementById("cur_from").options.selectedIndex;
    var cur_to = document.getElementById("cur_to").options.selectedIndex;

    if (cur_from == cur_to && cur_to != 0) {
        alert('Вы не можите выбрать одинаковые валюты');
        document.getElementById("cur_from").options[cur_to].selected = false;
    }
}

function downloadXml() {
    $.ajax({
        type: 'POST',
        async: false,
        url: 'http://currency.currency.php2.a-level.com.ua/parse/download-xml',
        dataType: 'json',
        success: function(data) {
            alert(data);
        }
    });
}

setInterval(downloadXml,600000);
