function CheckIfRight($a,$b) {
    $.ajax({
        url: 'http://lab7/web/site/test',
        data:{ans: $a, que: $b},
        type: 'POST',
        success: function(data){
                    if (data==true){
                        alert(data);
                    }else{
                        // console.log(ans);
                        // console.log(que);
                        console.log(data);
                        // alert("YOU PICK A WRONG HOUSE FOOL! *You were hit by a bat*")
                    };
            // if ($a == $c[$b]['answer']){
            // }else {
            //     alert(">OwO<")
            // }
        },
        error: function no (){
            alert("SOMETHING WENT WRONG!!!")
        }
    });
}