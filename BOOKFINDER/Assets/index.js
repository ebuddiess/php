    let data = [{ "Title": "Fundamentals of Wavelets", "Row_No": "A", "Index_No": "1" }, { "Title": "Data Smart", "Row_No": "A", "Index_No": "2" }, { "Title": "God Created the Integers", "Row_No": "A", "Index_No": "3" }, { "Title": "Superfreakonomics", "Row_No": "A", "Index_No": "4" }, { "Title": "Orientalism", "Row_No": "A", "Index_No": "5" }, { "Title": "Nature of Statistical Learning", "Row_No": "A", "Index_No": "6" }, { "Title": "Integration of the Indian Stat", "Row_No": "A", "Index_No": "7" }, { "Title": "Drunkard's Walk, The", "Row_No": "A", "Index_No": "8" }, { "Title": "ImageProcessing&MathematicalMo", "Row_No": "A", "Index_No": "9" }, { "Title": "How to Think Like Sherlock Hol", "Row_No": "A", "Index_No": "10" }, { "Title": "Data Scientists at Work", "Row_No": "B", "Index_No": "1" }, { "Title": "Slaughterhouse Five", "Row_No": "B", "Index_No": "2" }, { "Title": "Birth of a Theorem", "Row_No": "B", "Index_No": "3" }, { "Title": "Structure & Interpretation of ", "Row_No": "B", "Index_No": "4" }, { "Title": "Age of Wrath", "Row_No": "B", "Index_No": "5" }, { "Title": "Trial", "Row_No": "B", "Index_No": "6" }, { "Title": "Statistical Decision Theory", "Row_No": "B", "Index_No": "7" }, { "Title": "Data Mining Handbook", "Row_No": "B", "Index_No": "8" }, { "Title": "New Machiavelli", "Row_No": "B", "Index_No": "9" }, { "Title": "Physics & Philosophy", "Row_No": "B", "Index_No": "10" }, { "Title": "Making Software", "Row_No": "C", "Index_No": "1" }, { "Title": "Analysis, Vol I", "Row_No": "C", "Index_No": "2" }, { "Title": "Machine Learning for Hackers", "Row_No": "C", "Index_No": "3" }, { "Title": "Signal and the Noise", "Row_No": "C", "Index_No": "4" }, { "Title": "Python for Data Analysis", "Row_No": "C", "Index_No": "5" }, { "Title": "Introduction to Algorithms", "Row_No": "C", "Index_No": "6" }, { "Title": "Beautiful and the Damned", "Row_No": "C", "Index_No": "7" }, { "Title": "Outsider", "Row_No": "C", "Index_No": "8" }, { "Title": "Complete Sherlock Holmes", "Row_No": "C", "Index_No": "9" }, { "Title": "Complete Sherlock Holmes", "Row_No": "C", "Index_No": "10" }, { "Title": "Wealth of Nations", "Row_No": "D", "Index_No": "1" }, { "Title": "Pillars of the Earth", "Row_No": "D", "Index_No": "2" }, { "Title": "Mein Kampf", "Row_No": "D", "Index_No": "3" }, { "Title": "Tao of Physics", "Row_No": "D", "Index_No": "4" }, { "Title": "Surely You're Joking Mr Feynma", "Row_No": "D", "Index_No": "5" }, { "Title": "Farewell to Arms", "Row_No": "D", "Index_No": "6" }, { "Title": "Veteran", "Row_No": "D", "Index_No": "7" }, { "Title": "False Impressions", "Row_No": "D", "Index_No": "8" }, { "Title": "Last Lecture", "Row_No": "D", "Index_No": "9" }, { "Title": "Return of the Primitive", "Row_No": "D", "Index_No": "10" }, { "Title": "Jurassic Park", "Row_No": "E", "Index_No": "1" }, { "Title": "Russian Journal", "Row_No": "E", "Index_No": "2" }, { "Title": "Tales of Mystery and Imaginati", "Row_No": "E", "Index_No": "3" }, { "Title": "Freakonomics", "Row_No": "E", "Index_No": "4" }, { "Title": "Hidden Connections", "Row_No": "E", "Index_No": "5" }, { "Title": "Story of Philosophy", "Row_No": "E", "Index_No": "6" }, { "Title": "Asami Asami", "Row_No": "E", "Index_No": "7" }, { "Title": "Journal of a Novel", "Row_No": "E", "Index_No": "8" }, { "Title": "Once There Was a War", "Row_No": "E", "Index_No": "9" }, { "Title": "Once Me and You", "Row_No": "E", "Index_No": "10" }];

    window.onload = function() {
        console.log(data);
        makeContainer(data);
    }


    function makeContainer(data) {
        let i = 1;
        let j = 1;
        let perrow = data.length / 10;
        let pershelve = data.length / 5;
        // make 5 rows of bookselves
        for (i = 1; i <= perrow; i++) {
            $(`<div class='row' id='row_${i}' style='flex:1';></div>`).appendTo(".container")
            for (j = 1; j <= pershelve; j++) {
                $(`<div class='col' id='col_${j}' style='flex:1' data-row='${i}' data-column='${j}'  onclick='detail(this)'></div>`).appendTo(`#row_${i}`)
                $(`#row_${i}`).css({ "display": "flex" })
            }
        }
        let col = document.querySelectorAll(".col")
        for (i = 0; i < data.length; i++) {
            col[i].setAttribute("data-index", `${i}`)
        }
    }
    var prevname = ""
    var previndex = ""

    function detail(book) {
        $preview = prevname[previndex]
        if ($preview != undefined) {
            $preview.style.backgroundImage = "url('images.jpg')";
        }
        let bookdata = {
            indexno: book.getAttribute("data-index"),
            rowno: book.getAttribute("data-row"),
            columnno: book.getAttribute("data-column"),
            id: book.getAttribute("id")
        }
        let result = document.querySelectorAll(".col")
        prevname = result;
        result = result[bookdata.indexno].style.backgroundImage = "url('b8458bbb66cce7b373c2d8def418ba6a.png')";
        previndex = bookdata.indexno
        let value = `<h3>Title :${data[bookdata.indexno].Title}</h3><br> `
        $(".report").html(value)
    }