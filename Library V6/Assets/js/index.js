var x = 1;

function validate() {
    var file = document.getElementById("file").value;
    if (file.length === 0) {
        document.getElementById("labelError").textContent = "No File Selected";
        return false;
    } else {
        let data = file.split(".");
        if (data[1] != 'csv') {
            document.getElementById("labelError").textContent = "Please Select CSV File";
            return false;
        } else {
            return true;
        }
    }
}




function dropCompare() {
    let res = prompt("Type ok to delete the File");
    if (res == "ok") {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "../../Library/Scripts/Records/dropCompare.php", true);
        xhr.onload = function() {
            document.getElementById("records").innerHTML = this.responseText;
        };
        xhr.send();
    }
}

function compare() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Library/Scripts/Records/compare.php", true);
    xhr.onload = function() {
        document.getElementById("records").innerHTML = this.responseText;
    };
    xhr.send();
}

function compvalidate() {
    var file = document.getElementById("compfile").value;
    if (file.length === 0) {
        document.getElementById("labelError").textContent = "No File Selected";
        return false;
    } else {
        let data = file.split(".");
        if (data[1] != 'csv') {
            document.getElementById("labelError").textContent = "Please Select CSV File";
            return false;
        } else {
            return true;
        }
    }
}

function batchvalidate() {
    var file = document.getElementById("batchfile").value;
    if (file.length === 0) {
        document.getElementById("labelError").textContent = "No File Selected";
        return false;
    } else {
        let data = file.split(".");
        if (data[1] != 'csv') {
            document.getElementById("labelError").textContent = "Please Select CSV File";
            return false;
        } else {
            return true;
        }
    }
}


var filtercounter = 1;

function clearfilter() {
    filtercounter = 1;
    document.getElementById('records').innerHTML = "";
}
var firsttime = true;
var doneprev;

function prevfilter() {
    doneprev = false;
    value = document.getElementById("filter").value;
    if (filtercounter > 1) {
        filtervalue = Number(filtervalue) - Number(value);
        if (firsttime) {
            filtercounter = Number(filtercounter) - (Number(value) + Number(value));
            firsttime = false;
        } else {
            console.log("doneprev false");
            doneprev = true; //changed
            console.log("doneprev true");
            filtercounter = Number(filtercounter) - Number(value);
        }
        console.log("prevfiltercounter" + filtercounter);
        console.log("prevfiltervalue" + filtervalue);
        let xhr = new XMLHttpRequest();
        xhr.open("GET", `Scripts/Records/filter.php?filtervalue=${filtervalue}&filtercounter=${filtercounter}`, true);
        xhr.onload = function() {
            document.getElementById("records").innerHTML = this.responseText;
            document.getElementById("records").style.visibility = "visible";
        };
        xhr.send();
        document.getElementById('modelerror').innerHTML = "";
    }
}

function filter() {
    value = document.getElementById("filter").value;
    if (filtercounter > 1) {
        console.log("filtercounter" + filtercounter);
        filtervalue = Number(filtercounter) + Number(value);
        if (doneprev) {
            console.log("doneprev true inside filter");
            filtercounter = Number(filtercounter) + Number(value); //changed
            filtervalue = Number(filtervalue) + Number(value);
            doneprev = false;
            console.log("doneprev prev false inside filter");
        }

        console.log("filtervalue" + filtervalue);
        let xhr = new XMLHttpRequest();
        xhr.open("GET", `Scripts/Records/filter.php?filtervalue=${filtervalue}&filtercounter=${filtercounter}`, true);
        xhr.onload = function() {
            document.getElementById("records").innerHTML = this.responseText;
            document.getElementById("records").style.visibility = "visible";
        };
        xhr.send();
        document.getElementById('modelerror').innerHTML = "";
        filtercounter = filtervalue;
        console.log(filtercounter + "fgvalueafternext");
    } else {
        filtervalue = document.getElementById("filter").value;
        let xhr = new XMLHttpRequest();
        xhr.open("GET", `Scripts/Records/filter.php?filtervalue=${filtervalue}&filtercounter=${filtercounter}`, true);
        xhr.onload = function() {
            document.getElementById("records").innerHTML = this.responseText;
            document.getElementById("records").style.visibility = "visible";
        };
        xhr.send();
        document.getElementById('modelerror').innerHTML = "";
        filtercounter = filtervalue;
    }
}

function getRecords() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "Scripts/Records/records.php", true);
    xhr.onload = function() {
        document.getElementById("records").innerHTML = this.responseText;
    };
    xhr.send();
    document.getElementById('modelerror').innerHTML = "";
}

function dropRecords() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Library/Scripts/Records/drop.php", true);
    xhr.onload = function() {
        document.getElementById("records").innerHTML = this.responseText;
    };
    xhr.send();
}

function update(value) {
    var data = {
        bookid: document.getElementById('bookid').value,
        status: document.getElementById('Status').value,
        mrp: document.getElementById('mrp').value,
        booktype: document.getElementById('booktype').value,
        purchaseprice: document.getElementById('purchaseprice').value,
        saleprice: document.getElementById('saleprice').value,
        supplierid: document.getElementById('supplierid').value,
        purchasedate: document.getElementById('purchasedate').value
    }
    let xhr = new XMLHttpRequest();
    xhr.open("GET", `../../Library/Scripts/Records/update.php?bookid=${data.bookid}
    &status=${data.status}&mrp=${data.mrp}
    &booktype=${data.booktype}&purchaseprice=${data.purchaseprice}
    &saleprice=${data.saleprice}&supplierid=${data.supplierid}
    &purchasedate=${data.purchasedate}`, true);
    xhr.onload = function() {
        document.getElementById("modelerror").innerHTML = this.responseText;
    };
    xhr.send();
    return false;
}


function deleteRow(value) {
    var bookid = value.getAttribute("value");
    let xhr = new XMLHttpRequest();
    xhr.open("GET", `../../Library/Scripts/Records/delete.php?value=${bookid}`, true);
    xhr.onload = function() {
        document.getElementById("records").innerHTML = this.responseText;
    };
    xhr.send();
}

function search(value) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", `../../Library/Scripts/Records/search.php?value=${value}`, true);
    xhr.onload = function() {
        document.getElementById("records").innerHTML = this.responseText;
    };
    xhr.send();
}

function data(value) {
    var book = {
        bookid: value.getAttribute("data-bookid"),
        bookstatus: value.getAttribute("data-bookstatus"),
        booktype: value.getAttribute("data-booktype"),
        bookmrp: value.getAttribute("data-bookmrp"),
        bookpurchaseprice: value.getAttribute("data-bookpurchaseprice"),
        booksaleprice: value.getAttribute("data-booksaleprice"),
        booksupplierid: value.getAttribute("data-booksupplierid"),
        bookpurchasedate: value.getAttribute("data-bookpurchasedate"),
    }
    document.getElementById('bookid').value = book.bookid;
    document.getElementById('Status').value = book.bookstatus;
    document.getElementById('mrp').value = book.bookmrp;
    document.getElementById('booktype').value = book.booktype;
    document.getElementById('purchaseprice').value = book.bookpurchaseprice;
    document.getElementById('saleprice').value = book.booksaleprice;
    document.getElementById('supplierid').value = book.booksupplierid;
    document.getElementById('purchasedate').value = book.bookpurchasedate;

}