/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function ValidateToken(token) {
    jQuery.support.cors = true;
    $.ajax({
        url: 'https://mrs2-test.apphb.com/api/ValidateAccount/' + token,
        type: 'POST',   
        dataType: 'html',
        success: function (data) {
            alert(data);
        },
        error: function (x, y, z) {
            alert(x + '\n' + y + '\n' + z);
        }
    });
}

$(document).ready(function() {         
    //ValidateToken(token);
   
       
});