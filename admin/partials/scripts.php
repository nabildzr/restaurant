<!-- jQuery library js -->
<script src="/assets_dashboard/assets/js/lib/jquery-3.7.1.min.js"></script>
<!-- Bootstrap js -->
<script src="/assets_dashboard/assets/js/lib/bootstrap.bundle.min.js"></script>
<!-- Apex Chart js -->
<script src="/assets_dashboard/assets/js/lib/apexcharts.min.js"></script>
<!-- Data Table js -->
<script src="/assets_dashboard/assets/js/lib/dataTables.min.js"></script>
<!-- Iconify Font js -->
<script src="/assets_dashboard/assets/js/lib/iconify-icon.min.js"></script>
<!-- jQuery UI js -->
<script src="/assets_dashboard/assets/js/lib/jquery-ui.min.js"></script>
<!-- Vector Map js -->
<script src="/assets_dashboard/assets/js/lib/jquery-jvectormap-2.0.5.min.js"></script>
<script src="/assets_dashboard/assets/js/lib/jquery-jvectormap-world-mill-en.js"></script>
<!-- Popup js -->
<script src="/assets_dashboard/assets/js/lib/magnifc-popup.min.js"></script>
<!-- Slick Slider js -->
<script src="/assets_dashboard/assets/js/lib/slick.min.js"></script>
<!-- prism js -->
<script src="/assets_dashboard/assets/js/lib/prism.js"></script>
<!-- file upload js -->
<script src="/assets_dashboard/assets/js/lib/file-upload.js"></script>
<!-- audioplayer -->
<script src="/assets_dashboard/assets/js/lib/audioplayer.js"></script>

<!-- sweetalertsssss -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>

<!-- main js -->
<script src="/assets_dashboard/assets/js/app.js"></script>

<script>
    // =============================== Upload Single Image js start here ================================================
    const fileInput = document.getElementById("upload-file");
    const imagePreview = document.getElementById("uploaded-img__preview");
    const uploadedImgContainer = document.querySelector(".uploaded-img");
    const removeButton = document.querySelector(".uploaded-img__remove");

    fileInput.addEventListener("change", (e) => {
        if (e.target.files.length) {
            const src = URL.createObjectURL(e.target.files[0]);
            imagePreview.src = src;
            uploadedImgContainer.classList.remove("d-none");
        }
    });
    removeButton.addEventListener("click", () => {
        imagePreview.src = "";
        uploadedImgContainer.classList.add("d-none");
        fileInput.value = "";
    });
    // =============================== Upload Single Image js End here ================================================
</script>

<?php
/* 
1. $_GET['success'] yang di gunakan untuk memeriska apakah ada param success pada url
2. Jika ada param success maka nilai yang ada pada parameter tersebut akan di ambil dan disimpan pada var $x dan pada var $x nilai yang sudah di dapatkan akan di konversi menjadi integer menggunakan intval()
3. kemudian akan ditampilkannya alert dengan menggunakan echo yang dimana ditampilkannya itu adalah script js 
4. document.addEventListener('DOM...) digunakan untuk memastikan script akan dijalankan setelah ter reload
5. inisialisasi var x didalam script js yang sudah didapatkan menggunakan php ($x)
*/
?>



<?php

if (isset($_GET['alert'])) {
    $x = intval($_GET['alert']);
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var x = $x;
            if (x == 1) {

                    Swal.fire({
                        icon: 'success',
                        text: 'Successfully Deleted',
                        showConfirmButton: false,

                        timer: 2500,
                    })
                    
            } else if (x == 2) {
                    Swal.fire({
                        icon: 'success',
                        text: 'Successfully Added',
                                showConfirmButton: false,

                        timer: 1500,
                    });
            } else if (x == 3) {
                Swal.fire({
                    icon: 'success',
                    text: 'Successfully Updated',
                    customClass: {
                        popup: 'swal2-popup',
                        title: 'swal2-title',
                        content: 'swal2-content',
                        confirmButton: 'swal2-confirm'
                    }
                });
            } else if (x == 11) {
                Swal.fire({
                    icon: 'error',
                    text: 'Failed to Delete',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
            else if (x == 12) {
                Swal.fire({
                    icon: 'error',
                    text: 'Failed to Add',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
            else if (x == 13) {
                Swal.fire({
                    icon: 'error',
                    text: 'Failed to Update',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
            else if (x == 20) {
                Swal.fire({
                    icon: 'error',
                    text: 'Discount value must be between 0 and 999.99',
                    timer: 1500,
                    showConfirmButton: false
                });
         
            }
            else if (x == 21) {
                Swal.fire({
                    icon: 'error',
                    text: 'Invalid photo size. You must upload a photo with resolution: 180 x 180 pixels.',
                    timer: 1500,
                    showConfirmButton: false
                });
           
            }
            else if (x == 21) {
                Swal.fire({
                    icon: 'error',
                    text: 'Discount cannot be more than 99%. Please enter a valid discount.',
                    timer: 1500,
                    showConfirmButton: false
                });
           
            }
            else if (x == 400) {
                Swal.fire({
                    icon: 'error',
                    text: 'Something went wrong',
                    timer: 1500,
                    showConfirmButton: false
                })
            }

                      

              // Remove the 'in' parameter from the URL
        var url = new URL(window.location.href) ;
        url.searchParams.delete('alert');
        window.history.replaceState({}, document.title, url.toString());
        });
    </script>";
}



if (isset($_GET['updated'])) {
    $x = intval($_GET['updated']);
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var x = $x;
            if (x == 1) {

                    Swal.fire({
                        icon: 'success',
                        text: 'Successfully Updated',
                        showConfirmButton: false,

                        timer: 2500,
                    })
                   
                    
            } 
           else if (x == 0) {

                    Swal.fire({
                        icon: 'error',
                        text: 'Failed to Update',
                        showConfirmButton: false,

                        timer: 2500,
                    })
                    
                    
            } 


               // Remove the 'updated' parameter from the URL
        var url = new URL(window.location.href);
        url.searchParams.delete('updated');
        window.history.replaceState({}, document.title, url.toString());
        });
        
    </script>";
}

?>
<?php echo (isset($script) ? $script   : '') ?>