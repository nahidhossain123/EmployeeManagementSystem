
function MinimizeSideMenu()
{
    let text=document.getElementById('side-menu-collapse');
    text.style.marginLeft="-100%";
}
function Expand()
{
    let text=document.getElementById('side-menu-collapse');
    text.style.marginLeft="0";
}

const inputs=[];
function addField(){
    $(dynamic).append(`<div class="field">
    <input type="text" style="margin-right:5px" class="form-control"  placeholder="Allowance" name="allowance[]">
    <input type="text" style="margin-right:5px" class="form-control"  placeholder="Value" name="val[]">
    <span style="margin-top:5px" class="remove-button" onclick="Delete(this)"><i class="far fa-times-circle"></i></span>
    </div>`);   
}




function Delete(e)
{   
    e.parentElement.remove();
}

function Percent()
{   
    let basic=document.getElementById("basic");
    let home=document.getElementById("house");
    let covence=document.getElementById("covence");
    let mobile=document.getElementById("mobile");
    let total=document.getElementById("total");
    let sal=document.getElementById("salary").value;
    
    basic.innerHTML="Basic (30%): "+ ((30*sal)/100)+" BDT";
    home.innerHTML="House Rent (27%): "+ ((27*sal)/100)+" BDT";
    covence.innerHTML="Covence (13%): "+ ((17*sal)/100)+" BDT";
    mobile.innerHTML="Mobile Allowance (30%): "+ ((30*sal)/100)+" BDT";
    total.innerHTML="Total Salary (100%): "+ sal +" BDT";
    

}

