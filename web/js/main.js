function CheckIfRight($a, $b) {
    $.ajax({
        url: 'http://lab7/web/site/test',
        data:{answer: $a, question: $b},
        type: 'POST',
        success: function {
            alert("Hewwo");
        },
        error: function{
            alert("SOMETHING WENT WRONG!!!")
        }
    });
}