/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $.uploadPreview({
        input_field: "#image-upload",
        preview_box: "#image-preview",
        label_field: "#image-label",
        label_default: "Click Aquí", // Default: Choose File
        label_selected: "Cambiar" // Default: Change File
       
    });
    $.uploadPreview({
        input_field: "#image-upload2",
        preview_box: "#image-preview2",
        label_field: "#image-label2",
        label_default: "Click Aquí", // Default: Choose File
        label_selected: "Cambiar" // Default: Change File
        
    });
    $.uploadPreview({
        input_field: "#image-upload3",
        preview_box: "#image-preview3",
        label_field: "#image-label3",
        label_default: "Click Aquí", // Default: Choose File
        label_selected: "Cambiar" // Default: Change File
        
    });

});
