// Preloader
$(window).on('load', function() {
    $(".loading").fadeOut("slow", function() {
        $("#app").css('visibility', 'visible');
    });
});

// Preview gambar dari file chooser.
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#profile-img-tag').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function(){
    $('.datatables').DataTable({
        "language": {
            "lengthMenu": "Menampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ditemukan - maaf -v-",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_ halaman",
            "infoEmpty": "Data tidak ditemukan",
            "infoFiltered": "(disaring dari _MAX_ jumlah data)",
            "search": 'Cari:',
            "paginate": {
                "previous": "<i class='fas fa-caret-left'></i>",
                "next": "<i class='fas fa-caret-right'></i>"
            }
        },
        "iDisplayLength" : 4,
    });

    $('[data-toggle="tooltip"]').tooltip();

    $("input[type=file]").change(function () {
        var fieldVal = $(this).val();
      
        // Change the node's value by removing the fake path (Chrome)
        fieldVal = fieldVal.replace("C:\\fakepath\\", "");
          
        if (fieldVal != undefined || fieldVal != "") {
          $(this).next(".custom-file-label").attr('data-content', fieldVal);
          $(this).next(".custom-file-label").text(fieldVal);
        }
    });

    // Preview Foto
    $("#foto").change(function(){
        readURL(this);
    });

    // Animasi pas klik kelas di daftar nilai.
    $('.block').on('click', function(){
        var $index  = $(this).attr('data-panel');
        $('#'+$index).slideToggle(1000);
    });
});