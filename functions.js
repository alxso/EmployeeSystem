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
    setTimeout(() => { location.reload(); }, 1000);
}

function getIDtoEdit() {
    fetchid = ($("table .selected td:first-child").html());
    fname = document.getElementById("fname").value;
    mname = document.getElementById("mname").value;
    lname = document.getElementById("lname").value;
    email = document.getElementById("email").value;
    phone = document.getElementById("phone").value;
    hiredate = document.getElementById("hiredate").value;
    if (document.getElementById("active2").checked == false) {
        active2 = "NO";
    } else {
        active2 = "YES";
    }


    $.ajax({
        url: "employees.php",
        type: "post",
        dataType: 'json',
        data: { fetchid: fetchid, "callFunc2": "1", "fname": fname, "mname": mname, "lname": lname, "email": email, "phone": phone, "hiredate": hiredate, "active2": active2 },
        success: function(result) {
            console.log(result.abc);
        }
    });
    setTimeout(() => { location.reload(); }, 1000);

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