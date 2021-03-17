function handleMpesaInput(m)
{
    var paybillContainer = document.querySelector('#mpesa_paybill_number_container');
    var paybillInput = document.querySelector('#mpesa_paybill_number_input');

    if (m.checked)
    {
        paybillContainer.style.display = 'flex';
        paybillInput.required = true;
    } else
    {
        paybillInput.value = '';
        paybillContainer.style.display = 'none';
        paybillInput.required = false;
    }
}

function handleUtilityAccountNoInput(m)
{

    var kpMeterNoContainer = document.querySelector('#kenya_power_meter_number_container');
    var kpMeterNoInput = document.querySelector('#kenya_power_meter_number_input');

    var text = m.options[m.selectedIndex].text;

    switch(text) 
    {
        case 'Electricity':
            kpMeterNoContainer.style.display = 'flex';
            kpMeterNoInput.required = true;
            break;
        default:
            kpMeterNoContainer.style.display = 'none';
            kpMeterNoInput.required = false;
            break;
    }
}

$(document).ready(function(){

});

var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }

    myIndex++;

    if (myIndex > x.length) {
        myIndex = 1
    }   
     
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 9000);    
}