<div class="container">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
    <i class="bi bi-plus-lg"></i> 
    Tambah Gallery
</button>
    <div class="row">
        <div class="table-responsive" id="gallery_data">
            
        </div>
        <!-- Awal Modal Tambah-->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gallery</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Save" name="Save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah-->
    </div>
    <!-- Modal untuk Detail Data -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel">Detail Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="" id="detailImage" class="img-fluid mb-3" alt="Detail Gambar">
                    </div>
                    <p><strong>Tanggal:</strong> <span id="detailTanggal"></span></p>
                    <p><strong>Diunggah oleh:</strong> <span id="detailUsername"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    load_data();
    function load_data(hlm){
        $.ajax({
            url : "gallery_data.php",
            method : "POST",
            data : { hlm: hlm },
            success : function(data){
                    $('#gallery_data').html(data);
            }
        })
    } 

    $(document).on('click', '.halaman', function() {
    e.preventDefault();
    let hlm = $(this).attr('id'); // Ambil nomor halaman dari ID elemen
    load_data(hlm); // Panggil fungsi untuk memuat data sesuai halaman
});
});
</script>

<?php
include "upload_foto.php";

//jika tombol simpan diklik
if (isset($_POST['Save'])) {
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];


    //jika ada file yang dikirim  
    if ($nama_gambar != '') {
		    //panggil function upload_foto untuk cek spesifikasi file yg dikirimkan user
		    //function ini memiliki 2 keluaran yaitu status dan message
        $cek_upload = upload_foto($_FILES["gambar"]);

				//cek status true/false
        if ($cek_upload['status']) {
		        //jika true maka message berisi nama file gambar
            $gambar = $cek_upload['message'];
        } else {
		        //jika true maka message berisi pesan error, tampilkan dalam alert
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }

		//cek apakah ada id yang dikirimkan dari form
        if (isset($_POST['id'])) {
            //jika ada id,    lakukan update data dengan id tersebut
            $id = $_POST['id'];
    
            if ($nama_gambar == '') {
                //jika tidak ganti gambar
                $gambar = $_POST['gambar_lama'];
            } else {
                //jika ganti gambar, hapus gambar lama
                unlink("img/" . $_POST['gambar_lama']);
            }
        
            // Update data di database
            $stmt = $conn->prepare("UPDATE gallery 
                                    SET 
                                    gambar = ?,
                                    tanggal = ?,
                                    username = ?
                                    WHERE id = ?");
            $stmt->bind_param("sssi", $gambar, $tanggal, $username, $id);
            $simpan = $stmt->execute();
        } else {
            // Jika tidak ada ID, berarti melakukan proses insert
            $stmt = $conn->prepare("INSERT INTO gallery (gambar, tanggal, username)
                                    VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $gambar, $tanggal, $username);
            $simpan = $stmt->execute();
        }
        

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

//jika tombol hapus diklik
if (isset($_POST['Hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        //hapus file gambar
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id =?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=gallery';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=gallery';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<script>
    // Fungsi untuk memuat tabel data gallery
    function loadGalleryData() {
        fetch('gallery_data.php')
            .then(response => response.text())
            .then(html => {
                document.getElementById('gallery_data').innerHTML = html;

                // Tambahkan event listener untuk detail modal setelah data dimuat
                const detailTriggers = document.querySelectorAll('.detail-trigger');
                const detailImage = document.getElementById('detailImage');
                const detailTanggal = document.getElementById('detailTanggal');
                const detailUsername = document.getElementById('detailUsername');

                detailTriggers.forEach(trigger => {
                    trigger.addEventListener('click', function () {
                        const imageSrc = this.dataset.image;
                        const tanggal = this.dataset.tanggal;
                        const username = this.dataset.username;

                        detailImage.src = imageSrc;
                        detailTanggal.textContent = tanggal;
                        detailUsername.textContent = username;
                    });
                });
            });
    }

    // Panggil fungsi untuk memuat data setelah halaman dimuat
    document.addEventListener('DOMContentLoaded', loadGalleryData);
</script>


