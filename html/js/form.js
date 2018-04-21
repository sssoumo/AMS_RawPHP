$(document).ready(function(){
//    $(":input:text").keyup(function(){
//        alert("Keyup");
//        
//    });
//     $(":input:password").keyup(function(){
//        alert("Keydown");
//     });
//     
//         
//                 });


$("#bgcolor").change(function(){
    var color= $(this).val();
    $("body").css("background",color);
});
});