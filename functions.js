function getIDtoRemove() {

    fetchid = ($("table .selected td:first-child").html());

    $.ajax({
        url: "employees.php",
        type: "post",
        dataType: 'json',
        data: { fetchid: fetchid, "callFunc1": "1" },
        success: function(result) {
            console.log(result.abc);
        }
    });
}

function getIDtoEdit() {
    fetchid = ($("table .selected td:first-child").html());
    fname = document.getElementById("fname").value;
    mname = document.getElementById("mname").value;
    lname = document.getElementById("lname").value;
    email = document.getElementById("email").value;
    phone = document.getElementById("phone").value;
    hiredate = document.getElementById("hiredate").value;
    $.ajax({
        url: "employees.php",
        type: "post",
        dataType: 'json',
        data: { fetchid: fetchid, "callFunc2": "1", "fname": fname, "mname": mname, "lname": lname, "email": email, "phone": phone, "hiredate": hiredate },
        success: function(result) {
            console.log(result.abc);
        }
    });
}

$(document).ready(function() {

    function highlight(e) {
        if (selected[0]) selected[0].className = '';
        e.target.parentNode.className = 'selected';
    }

    var table = document.getElementById('table');
    var selected = table.getElementsByClassName('selected');
    table.onclick = highlight;

});