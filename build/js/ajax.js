$(document).ready(function() {
    $("#btn_tambah_warkah").click(function() {
        kosongkan_album();
        album_tidak_aktif(false);

        $("#btn_tambah_album").show();
        $("#btn_tambah_album").attr("disabled", true);

        $("#btn_simpan_album").show();
        $("#btn_simpan_album").attr("disabled", false);

        kosongkan_di208();
        di208_tidak_aktif(true);

        $("#btn_simpan_di208").show();
        $("#btn_simpan_di208").attr("disabled", true);
        $("#btn_ubah_di208").hide();

        $("#pesan-simpan, #pesan-sukses, #pesan-eror").hide();

        $("#baris_lorong").find('option').remove().end().append('<option value="0">Pilih Posisi...</option>');
    });

    $("#baris").change(function() {   
        let pilih = $("#baris").val();     
        let data = new FormData();

        data.append('pilih', pilih);
        
        if(pilih == 0) {
            $("#baris_lorong").find('option').remove().end().append('<option value="0">Pilih Posisi...</option>');
       
        } else {
            $.ajax({
                url: 'baris_lorong.php', // File tujuan
                type: 'POST', // Tentukan type nya POST atau GET
                data: data, // Set data yang akan dikirim
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                    $.blockUI({
                        message: 'sedang proses...',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff',
                            size: '20px'
                        }
                    });
                },
                success: function(response) { // Ketika proses pengiriman berhasil	
                    $.unblockUI();                
                    if (response.status == "sukses") {
                        $("#baris_lorong").find('option').remove().end().append('<option value="0">Pilih Posisi...</option>');
                                                
                        for(let i=0;i<response.id_baris_lorong.length;i++) {
                            $("#baris_lorong").
                                append(`<option value=${response.id_baris_lorong[i]}>
                                    ${response.posisi_baris_lorong[i]}</option>`);
                        }
                                 
                    } else {
                        Swal.fire({ //  muncul sweet alert
                            title: response.pesan,
                            type: response.tipe,
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                    $.unblockUI();
                    alert(xhr.responseText); // munculkan alert
                }
            });
        }
    });

    $("#btn_simpan_album").click(function() {
        var id_tower = $("#tower").val();
        var no_rak = $("#nomor_rak").val();
        var id_kolom = $("#kolom").val();
        var id_baris = $("#baris").val();
        var baris_lorong = $("#baris_lorong").val();
        var album_no = $("#album_nomor").val();

        $("#hidden_tower_id").val(id_tower);
        $("#hidden_nama_rak").val($(".nama_rak:checked").val());
        $("#hidden_no_rak").val(no_rak);
        $("#hidden_kolom_id").val(id_kolom);
        $("#hidden_baris_id").val(id_baris);
        $("#hidden_baris_lorong_id").val(baris_lorong);
        $("#hidden_album_no").val(album_no);

        cek_isian_album(id_tower, no_rak, id_kolom, id_baris, baris_lorong, album_no);

    });

    $("#btn_tambah_album").click(function() {
        // script sama seperti tambah warkah click
        kosongkan_album();
        album_tidak_aktif(false);

        $("#btn_tambah_album").show();
        $("#btn_tambah_album").attr("disabled", true);

        $("#btn_simpan_album").show();
        $("#btn_simpan_album").attr("disabled", false);

        kosongkan_di208();
        di208_tidak_aktif(true);

        $("#btn_simpan_di208").show();
        $("#btn_simpan_di208").attr("disabled", true);
        $("#btn_ubah_di208").hide();

        $("#pesan-simpan, #pesan-sukses, #pesan-eror").hide();
        $("#baris_lorong").find('option').remove().end().append('<option value="0">Pilih Baris atau Lorong...</option>');
    });

    $("#btn_simpan_di208").click(function() {
        var data = new FormData();

        data.append('id_warkah', $("#hidden_warkah_id").val());
        data.append('id_tower', $("#hidden_tower_id").val());
        data.append('nama_rak', $("#hidden_nama_rak").val());
        data.append('no_rak', $("#hidden_no_rak").val());
        data.append('id_kolom', $("#hidden_kolom_id").val());
        data.append('id_baris', $("#hidden_baris_id").val());
        data.append('baris_lorong_id', $("#hidden_baris_lorong_id").val());
        data.append('no_album', $("#hidden_album_no").val());

        data.append('di208_nomor', $("#di208_nomor").val());
        data.append('di208_tahun', $("#di208_tahun").val());
        data.append('scan_warkah', $(".scan_warkah:checked").val());

        $.ajax({
            url: 'simpan_data_di208.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",


            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();
                /*		
                		Swal.fire({		//  muncul sweet alert
                			title: response.judul,
                			text: response.pesan,
                			type: response.tipe,
                			allowOutsideClick: false,
                		});
                */
                if (response.status == "sukses") {
                    if (response.jenis_simpan == 1) { // jika jenis simpan insert
                        $("#pesan-sukses").html(response.pesan).fadeIn().delay(1000).fadeOut();
                        kosongkan_di208();
                    }
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_ubah_di208").click(function() {
        var data = new FormData();

        data.append('id_warkah', $("#hidden_warkah_id").val());
        data.append('id_tower', $("#tower").val());
        data.append('nama_rak', $(".nama_rak:checked").val());
        data.append('no_rak', $("#nomor_rak").val());
        data.append('id_kolom', $("#kolom").val());
        data.append('id_baris', $("#baris").val());
        data.append('no_album', $("#album_nomor").val());

        data.append('di208_nomor', $("#di208_nomor").val());
        data.append('di208_tahun', $("#di208_tahun").val());
        data.append('scan_warkah', $(".scan_warkah:checked").val());

        $.ajax({
            url: 'simpan_data_di208.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",


            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();
                /*		
                		Swal.fire({		//  muncul sweet alert
                			title: response.judul,
                			text: response.pesan,
                			type: response.tipe,
                			allowOutsideClick: false,
                		});
                */
                if (response.status == "sukses") {
                    if (response.jenis_simpan == 2) { // jika jenis simpan update
                        $("#pesan-sukses").html(response.pesan).fadeIn().delay(1000).fadeOut();
                    }
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_cari_warkah").click(function() {

        var data = new FormData();
        data.append('txt_cari_di208_nomor', $("#txt_cari_di208_nomor").val());
        data.append('txt_cari_di208_tahun', $("#txt_cari_di208_tahun").val());

        $.ajax({
            url: 'cari_warkah.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",

            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();

                if (response.status == "sukses") {
                    $("#tampilkan_data_warkah").html(response.hasil);
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_hapus_warkah").click(function() { // Ketika tombol hapus di klik
        // Buat variabel data untuk menampung data hasil input dari form
        var data = new FormData();
        data.append('id_warkah_hapus', $("#id_warkah_hapus").val()); // Ambil data nis
        data.append('di208_nomor_hapus', $("#di208_nomor_hapus").val());
        data.append('di208_tahun_hapus', $("#di208_tahun_hapus").val());

        $.ajax({
            url: 'hapus_warkah.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil
                $.unblockUI();
                $("#tampilkan_data_warkah").html(response.hasil);
                $("#delete-modal-warkah").modal('hide'); // Close / Tutup Modal Dialog
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert("ERROR : " + xhr.responseText); // Munculkan alert
            }
        });
    });

    $("#btn_laporan").click(function() {

        var data = new FormData();
        data.append('txt_cari_laporan', $("#txt_cari_laporan").val());

        $.ajax({
            url: 'cari_laporan.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",

            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();

                if (response.status == "sukses") {
                    $("#tampilkan_data_laporan").html(response.hasil);
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_eksport_excel").click(function() {

        var data = new FormData();
        data.append('txt_cari_laporan', $("#txt_cari_laporan").val());

        $.ajax({
            url: 'cetak_excel.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: { txt_cari_laporan: $("#txt_cari_laporan").val() },
            dataType: "json",

            success: function(response) { // Ketika proses pengiriman berhasil	
                window.location.href = response.url;
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_login").click(function() {
        var data = new FormData();

        data.append('username', $("#loginUser").val());
        data.append('password', $("#loginPassword").val());

        $.ajax({
            url: 'proses_login.php',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",

            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) {
                $.unblockUI();

                if (response.status == "sukses") {
                    $("#loginform input").val("");
                    window.location.href = response.url;
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_simpan_pengguna").click(function() {
        var data = new FormData();

        data.append('hidden_username', $("#hidden_username").val());
        data.append('username_baru', $("#txt_username").val());
        data.append('nama', $("#txt_nama").val());
        data.append('password', $("#txt_password").val());
        data.append('otoritas', $("#otoritas").val());

        $.ajax({
            url: 'simpan_username.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",


            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();
                /*		
                		Swal.fire({		//  muncul sweet alert
                			title: response.judul,
                			text: response.pesan,
                			type: response.tipe,
                			allowOutsideClick: false,
                		});
                */
                if (response.status == "sukses") {
                    if (response.jenis_simpan == 1) { // jika jenis simpan insert
                        $("#pesan-sukses-pengguna").html(response.pesan).fadeIn().delay(1000).fadeOut();
                    }
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_cari_nama").click(function() {

        var data = new FormData();
        data.append('txt_cari_nama', $("#txt_cari_nama").val());

        $.ajax({
            url: 'cari_username.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",

            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();

                if (response.status == "sukses") {
                    $("#tampilkan_data_user").html(response.hasil);
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_ubah_pengguna").click(function() {
        var data = new FormData();

        data.append('hidden_username', $("#hidden_username").val());
        data.append('username_baru', $("#txt_username").val());
        data.append('nama', $("#txt_nama").val());
        data.append('password', $("#txt_password").val());
        data.append('otoritas', $("#otoritas").val());

        $.ajax({
            url: 'simpan_username.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",


            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();
                /*		
                		Swal.fire({		//  muncul sweet alert
                			title: response.judul,
                			text: response.pesan,
                			type: response.tipe,
                			allowOutsideClick: false,
                		});
                */
                if (response.status == "sukses") {
                    if (response.jenis_simpan == 2) { // jika jenis simpan update
                        $("#pesan-sukses-pengguna").html(response.pesan).fadeIn().delay(1000).fadeOut();
                    }
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_hapus_username").click(function() { // Ketika tombol hapus di klik
        // Buat variabel data untuk menampung data hasil input dari form
        var data = new FormData();
        data.append('username_hapus', $("#username_hapus").val()); // Ambil data nis

        $.ajax({
            url: 'hapus_username.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil
                $.unblockUI();
                $("#tampilkan_data_user").html(response.hasil);
                $("#delete-modal-username").modal('hide'); // Close / Tutup Modal Dialog
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert("ERROR : " + xhr.responseText); // Munculkan alert
            }
        });
    });


    $("#btn_cari_peminjaman").click(function() {
        var data = new FormData();
        data.append('cari_peminjaman', $("#txt_cari_peminjaman").val());
        data.append('cari_peminjaman_tahun', $("#txt_cari_peminjaman_tahun").val());

        $.ajax({
            url: 'cari_peminjaman.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",

            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();

                if (response.status == "sukses") {
                    $("#tampilkan_data_peminjaman").html(response.hasil);
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_simpan_peminjaman").click(function() {
        var data = new FormData();

        data.append('id_peminjaman', $("#hidden_id_peminjaman").val());
        data.append('id_warkah_peminjaman', $("#hidden_id_warkah_peminjaman").val());
        data.append('status', $("#hidden_status_peminjaman").val());
        data.append('keperluan', $("#isi_keperluan").val());
        data.append('pinjam_kembali', 'Y');

        data.append('di208_nomor_cari', $("#txt_cari_peminjaman").val()); // berasal dari peminjaman.php
        data.append('di208_tahun_cari', $("#txt_cari_peminjaman_tahun").val()); // berasal dari peminjaman.php

        $.ajax({
            url: 'simpan_peminjaman.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",


            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();

                if (response.status == "sukses") {
                    $("#tampilkan_data_peminjaman").html(response.hasil);
                    $("#modal-peminjaman").modal('hide');
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_kembalikan_peminjaman").click(function() {
        var data = new FormData();

        data.append('id_peminjaman', $("#hidden_id_peminjaman").val());
        data.append('id_warkah_peminjaman', $("#hidden_id_warkah_peminjaman").val());
        data.append('status', $("#hidden_status_peminjaman").val());
        data.append('keperluan', $("#isi_keperluan").val());
        data.append('pinjam_kembali', 'N');

        data.append('di208_nomor_cari', $("#txt_cari_peminjaman").val()); // berasal dari peminjaman.php
        data.append('di208_tahun_cari', $("#txt_cari_peminjaman_tahun").val()); // berasal dari peminjaman.php

        $.ajax({
            url: 'simpan_peminjaman.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",


            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();

                if (response.status == "sukses") {
                    $("#tampilkan_data_peminjaman").html(response.hasil);
                    $("#modal-peminjaman").modal('hide');
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });

    $("#btn_terima_warkah").click(function() {
        var data = new FormData();

        data.append('id_peminjaman', $("#hidden_id_peminjaman").val());
        data.append('id_warkah_peminjaman', $("#hidden_id_warkah_peminjaman").val());
        data.append('status', $("#hidden_status_peminjaman").val());
        data.append('keperluan', $("#isi_keperluan").val());
        data.append('pinjam_kembali', 'O');

        data.append('di208_nomor_cari', $("#txt_cari_peminjaman").val()); // berasal dari peminjaman.php
        data.append('di208_tahun_cari', $("#txt_cari_peminjaman_tahun").val()); // berasal dari peminjaman.php

        $.ajax({
            url: 'simpan_peminjaman.php', // File tujuan
            type: 'POST', // Tentukan type nya POST atau GET
            data: data, // Set data yang akan dikirim
            processData: false,
            contentType: false,
            dataType: "json",


            beforeSend: function(e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
                $.blockUI({
                    message: 'sedang proses...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff',
                        size: '20px'
                    }
                });
            },
            success: function(response) { // Ketika proses pengiriman berhasil	
                $.unblockUI();

                if (response.status == "sukses") {
                    $("#tampilkan_data_peminjaman").html(response.hasil);
                    $("#modal-peminjaman").modal('hide');
                } else {
                    Swal.fire({ //  muncul sweet alert
                        title: response.pesan,
                        type: response.tipe,
                        allowOutsideClick: false,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                $.unblockUI();
                alert(xhr.responseText); // munculkan alert
            }
        });
    });


    $("#btn_tambah_username").click(function() {
        kosongkan_pengguna();

        $("#btn_ubah_pengguna").hide();
        $("#pesan-sukses-pengguna").hide();
    });

    $("#txt_cari_di208_nomor, #txt_cari_di208_tahun").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $("#btn_cari_warkah").click();
        }
    });

    $("#txt_cari_laporan").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $("#btn_laporan").click();
        }
    });

    $("#txt_cari_nama").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $("#btn_cari_nama").click();
        }
    });

    $("#loginUser, #loginPassword").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $("#btn_login").click();
        }
    });

    $("#txt_cari_peminjaman, #txt_cari_peminjaman_tahun").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $("#btn_cari_peminjaman").click();
        }
    });

});

function kosongkan_album() {
    $("#hidden_warkah_id").val("");
    $("#hidden_tower_id").val("");
    $("#hidden_nama_rak").val("");
    $("#hidden_no_rak").val("");
    $("#hidden_kolom_id").val("");
    $("#hidden_baris_id").val("");
    $("#hidden_baris_lorong_id").val("");
    $("#hidden_album_no").val("");

    $("#tower").val(0);

    $('.nama_rak[value="A"]').iCheck('check');
    $("#nomor_rak").val(0);

    $("#kolom").val(0);
    $("#baris").val(0);
    $("#baris_lorong").val(0);

    $("#album_nomor").val("");
}

function album_tidak_aktif(aktif) {
    $("#tower").attr("disabled", aktif);
    $('.nama_rak').attr("disabled", aktif);
    $("#nomor_rak").attr("disabled", aktif);
    $("#kolom").attr("disabled", aktif);
    $("#baris").attr("disabled", aktif);
    $("#baris_lorong").attr("disabled", aktif);
    $("#album_nomor").attr("disabled", aktif);
}

function kosongkan_di208() {
    $("#di208_nomor").val("");
    $("#di208_tahun").val("");
    $('.scan_warkah[value="I"]').iCheck('check');
}

function di208_tidak_aktif(aktif) {
    $("#di208_nomor").attr("disabled", aktif);
    $("#di208_tahun").attr("disabled", aktif);
    $('.scan_warkah').attr("disabled", aktif);
}

function cek_isian_album(id_tower, no_rak, id_kolom, id_baris, baris_lorong, album_no) {
    var pesan = "";
    var error = false;

    if (id_tower == 0) {
        error = true;
        pesan = "pilih tower";
    } else if (no_rak == 0) {
        error = true;
        pesan = "pilih nomor rak";
    } else if (id_kolom == 0) {
        error = true;
        pesan = "pilih kolom";
    } else if (id_baris == 0) {
        error = true;
        pesan = "pilih baris atau lorong";
    } else if (baris_lorong == 0) {
        error = true;
        pesan = "pilih posisi";
    } else if (album_no.length < 1) {
        error = true;
        pesan = "nomor album harus diisi angka";
    }

    if (error) {
        Swal.fire({ //  muncul sweet alert
            title: pesan,
            type: 'error',
            allowOutsideClick: false,
        });
    } else {
        album_tidak_aktif(true);
        $("#btn_tambah_album").attr("disabled", false);
        $("#btn_simpan_album").attr("disabled", true);

        kosongkan_di208();
        di208_tidak_aktif(false);

        $("#btn_simpan_di208").show();
        $("#btn_simpan_di208").attr("disabled", false);
        $("#btn_ubah_di208").hide();
    }
}

function kosongkan_pengguna() {
    $("#hidden_username").val("");
    $("#txt_username").val("");
    $("#txt_nama").val("");
    $("#txt_password").val("");
    $("#otoritas").val(0);
}