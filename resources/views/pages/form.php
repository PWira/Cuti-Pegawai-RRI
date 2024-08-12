<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengantar Cuti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../../../dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)-->
    <style>
        .letter-container {
            max-width: 75%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: white;
        }
    </style>
</head>
<body>
    <div class="card card-info card-outline mb-4"> <!--begin::Header-->
        <div class="card-header" style="text-align:center;">
            <h3 class="">Surat Pengantar Cuti</h3>
        </div> <!--end::Header--> <!--begin::Form-->
        <!-- <p></p> -->
        <div class="letter-container">
            <form class="needs-validation" novalidate> <!--begin::Body-->
            <p>Yang bertanda tangan di bawah ini:</p>
                <div class="card-body"> <!--begin::Row-->
                    <div class="row g-2"> <!--begin::Col-->
                        <div class="col-md-4"> <label for="nama" class="form-label">Nama Lengkap</label> <input type="text" class="form-control" id="nama_pegawai" placeholder="Nama Lengkap" required>
                            <div class="valid-feedback"></div>
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-4"> <label for="jabatan" class="form-label">Jabatan</label> <input type="text" class="form-control" id="jabatan" placeholder="Jabatan" required>
                            <div class="valid-feedback"></div>
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-4"> <label for="departemen" class="form-label">Departemen</label> <input type="text" class="form-control" id="departemen" placeholder="departemen" required>
                            <div class="valid-feedback"></div>
                        </div> <!--end::Col--> <!--begin::Col-->
                        <p class="mt-2">Dengan ini mengajukan cuti dengan rincian sebagai berikut:</p>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="jenisCuti" class="form-label">Jenis Cuti</label>
                                <select class="form-select form-select-sm" id="jenisCuti" name="jenisCuti" required>
                                    <option value="">Pilih jenis cuti</option>
                                    <option value="Tahunan">Cuti Tahunan</option>
                                    <option value="Sakit">Cuti Sakit</option>
                                    <option value="Melahirkan">Cuti Melahirkan</option>
                                    <option value="Penting">Cuti Karena Alasan Penting</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="tanggalMulai" class="form-label">Mulai Cuti</label>
                                <input type="date" class="form-control" id="tanggalMulai" name="tanggalMulai" required>
                            </div>
                            <div class="col-md-3">
                                <label for="tanggalSelesai" class="form-label">Selesai Cuti</label>
                                <input type="date" class="form-control" id="tanggalSelesai" name="tanggalSelesai" required>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="alasan" class="form-label">Alasan Cuti</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="2" required></textarea>
                        </div>

                    </div> <!--end::Row-->
                </div> <!--end::Body--> <!--begin::Footer-->
                <div class="card-footer"> <button class="btn btn-info" type="submit">Submit form</button> </div> <!--end::Footer-->
            </form> <!--end::Form--> <!--begin::JavaScript-->
        </div>
    </div> <!--end::Form Validation-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (() => {
                "use strict";

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms =
                    document.querySelectorAll(".needs-validation");

                // Loop over them and prevent submission
                Array.from(forms).forEach((form) => {
                    form.addEventListener(
                        "submit",
                        (event) => {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }

                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            })();
        </script> <!--end::JavaScript-->
</body>
</html>