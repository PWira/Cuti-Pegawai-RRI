@extends('adminlte.layouts.app')

@section('content')

@auth

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta charset="utf-8" />
</head>

<body style="margin: 0;">

    <div style="position: absolute; right: 450px; top: 200px;">
        <button type="submit" class="btn btn-primary">Submit</button>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
        </div>
    </div>

    <div id="p1" style="overflow: hidden; position: relative; background-color: white; width: 935px; height: 1540px;">

        {{-- LAKUKAN IMPLEMENTASI DENGAN DOWNLOAD DOC --}}

    <!-- Begin inline CSS -->
    <style type="text/css" >

        #t1_1{left:490px;bottom:1462px;letter-spacing:-0.01px;word-spacing:0.01px;}
        #t2_1{left:490px;bottom:1446px;}
        #t3_1{left:490px;bottom:1430px;letter-spacing:-0.03px;word-spacing:0.03px;}
        #t4_1{left:490px;bottom:1414px;letter-spacing:0.01px;word-spacing:-0.01px;}
        #t5_1{left:490px;bottom:1399px;letter-spacing:0.05px;}
        #t6_1{left:490px;bottom:1383px;letter-spacing:-0.01px;word-spacing:0.01px;}
        #t7_1{left:616px;bottom:1323px;letter-spacing:-0.12px;}
        #t8_1{left:587px;bottom:1303px;letter-spacing:-0.11px;}
        #t9_1{left:616px;bottom:1303px;letter-spacing:-0.15px;word-spacing:0.1px;}
        #ta_1{left:616px;bottom:1283px;letter-spacing:-0.1px;}
        #tb_1{left:653px;bottom:1263px;letter-spacing:-0.14px;}
        #tc_1{left:491px;bottom:1184px;letter-spacing:-0.28px;}
        #td_1{left:491px;bottom:1164px;letter-spacing:-0.12px;word-spacing:0.07px;}
        #te_1{left:627px;bottom:1164px;}
        #tf_1{left:652px;bottom:1165px;letter-spacing:0.24px;}
        #tg_1{left:710px;bottom:1164px;}
        #th_1{left:749px;bottom:1164px;letter-spacing:-0.12px;}
        #ti_1{left:340px;bottom:1084px;}
        #tj_1{left:710px;bottom:1084px;}
        #tk_1{left:341px;bottom:1064px;}
        #tl_1{left:710px;bottom:1064px;}
        #tm_1{left:341px;bottom:1044px;}
        #tn_1{left:710px;bottom:1044px;}
        #to_1{left:81px;bottom:925px;letter-spacing:-0.15px;}
        #tp_1{left:185px;bottom:924px;}
        #tq_1{left:242px;bottom:925px;letter-spacing:-0.11px;}
        #tr_1{left:520px;bottom:927px;}
        #ts_1{left:623px;bottom:925px;letter-spacing:-0.07px;}
        #tt_1{left:340px;bottom:865px;}
        #tu_1{left:710px;bottom:865px;}
        #tv_1{left:81px;bottom:845px;letter-spacing:-0.13px;}
        #tw_1{left:177px;bottom:845px;letter-spacing:-0.15px;}
        #tx_1{left:243px;bottom:845px;letter-spacing:-0.11px;}
        #ty_1{left:312px;bottom:845px;letter-spacing:-0.13px;}
        #tz_1{left:710px;bottom:845px;}
        #t10_1{left:81px;bottom:825px;letter-spacing:-0.21px;}
        #t11_1{left:251px;bottom:825px;}
        #t12_1{left:330px;bottom:825px;letter-spacing:-0.13px;}
        #t13_1{left:710px;bottom:825px;}
        #t14_1{left:81px;bottom:805px;letter-spacing:-0.21px;}
        #t15_1{left:251px;bottom:805px;}
        #t16_1{left:330px;bottom:805px;letter-spacing:-0.13px;}
        #t17_1{left:710px;bottom:805px;}
        #t18_1{left:81px;bottom:786px;}
        #t19_1{left:248px;bottom:786px;letter-spacing:-0.13px;}
        #t1a_1{left:330px;bottom:786px;letter-spacing:-0.13px;}
        #t1b_1{left:397px;bottom:786px;letter-spacing:-0.17px;word-spacing:0.1px;}
        #t1c_1{left:710px;bottom:786px;}
        #t1d_1{left:652px;bottom:746px;letter-spacing:-0.2px;}
        #t1e_1{left:87px;bottom:607px;letter-spacing:-0.18px;}
        #t1f_1{left:185px;bottom:607px;}
        #t1g_1{left:117px;bottom:587px;}
        #t1h_1{left:87px;bottom:416px;letter-spacing:-0.18px;}
        #t1i_1{left:185px;bottom:416px;}
        #t1j_1{left:117px;bottom:395px;}
        #t1k_1{left:649px;bottom:367px;letter-spacing:-0.14px;word-spacing:0.07px;}
        #t1l_1{left:104px;bottom:271px;letter-spacing:-0.1px;word-spacing:0.11px;}
        #t1m_1{left:104px;bottom:256px;}
        #t1n_1{left:218px;bottom:256px;letter-spacing:0.15px;word-spacing:-0.04px;}
        #t1o_1{left:104px;bottom:243px;letter-spacing:0.11px;}
        #t1p_1{left:218px;bottom:242px;letter-spacing:0.19px;word-spacing:-0.07px;}
        #t1q_1{left:459px;bottom:242px;letter-spacing:0.25px;}
        #t1r_1{left:104px;bottom:229px;letter-spacing:0.11px;}
        #t1s_1{left:218px;bottom:229px;letter-spacing:0.18px;word-spacing:-0.06px;}
        #t1t_1{left:104px;bottom:216px;letter-spacing:0.11px;}
        #t1u_1{left:218px;bottom:215px;letter-spacing:0.18px;word-spacing:-0.06px;}
        #t1v_1{left:326px;bottom:215px;}
        #t1w_1{left:333px;bottom:215px;letter-spacing:0.15px;word-spacing:-0.02px;}
        #t1x_1{left:104px;bottom:203px;}
        #t1y_1{left:218px;bottom:203px;letter-spacing:0.19px;word-spacing:-0.08px;}
        #t1z_1{left:104px;bottom:189px;letter-spacing:0.08px;}
        #t20_1{left:218px;bottom:189px;letter-spacing:0.18px;word-spacing:-0.05px;}
        #t21_1{left:104px;bottom:176px;letter-spacing:0.08px;}
        #t22_1{left:218px;bottom:176px;letter-spacing:0.18px;word-spacing:-0.05px;}
        #t23_1{left:81px;bottom:1045px;letter-spacing:-0.1px;word-spacing:0.07px;}
        #t24_1{left:397px;bottom:1045px;letter-spacing:-0.13px;word-spacing:0.09px;}
        #t25_1{left:182px;bottom:816px;letter-spacing:-0.13px;}
        #t26_1{left:651px;bottom:558px;letter-spacing:0.21px;word-spacing:-0.08px;}
        #t27_1{left:250px;bottom:416px;letter-spacing:-0.2px;}
        #t28_1{left:435px;bottom:416px;letter-spacing:-0.21px;}
        #t29_1{left:653px;bottom:416px;letter-spacing:-0.22px;word-spacing:0.15px;}
        #t2a_1{left:704px;bottom:727px;letter-spacing:-0.17px;word-spacing:0.13px;}
        #t2b_1{left:669px;bottom:667px;letter-spacing:-0.13px;word-spacing:0.08px;}
        #t2c_1{left:333px;bottom:697px;letter-spacing:-0.14px;}
        #t2d_1{left:664px;bottom:647px;letter-spacing:-0.13px;word-spacing:0.08px;}
        #t2e_1{left:397px;bottom:806px;letter-spacing:-0.17px;word-spacing:0.1px;}
        #t2f_1{left:644px;bottom:309px;letter-spacing:-0.11px;word-spacing:0.06px;}
        #t2g_1{left:642px;bottom:292px;letter-spacing:-0.13px;word-spacing:0.08px;}
        #t2h_1{left:81px;bottom:627px;letter-spacing:-0.15px;word-spacing:0.07px;}
        #t2i_1{left:250px;bottom:608px;letter-spacing:-0.2px;}
        #t2j_1{left:435px;bottom:608px;letter-spacing:-0.21px;}
        #t2k_1{left:653px;bottom:608px;letter-spacing:-0.22px;word-spacing:0.15px;}
        #t2l_1{left:302px;bottom:588px;}
        #t2m_1{left:501px;bottom:588px;}
        #t2n_1{left:720px;bottom:588px;}
        #t2o_1{left:302px;bottom:396px;}
        #t2p_1{left:501px;bottom:396px;}
        #t2q_1{left:720px;bottom:396px;}
        #t2r_1{left:81px;bottom:436px;letter-spacing:-0.15px;word-spacing:0.06px;}
        #t2s_1{left:672px;bottom:492px;letter-spacing:-0.14px;word-spacing:0.11px;}
        #t2t_1{left:640px;bottom:472px;letter-spacing:-0.19px;}
        #t2u_1{left:673px;bottom:472px;letter-spacing:-0.12px;word-spacing:0.07px;}
        #t2v_1{left:81px;bottom:746px;letter-spacing:-0.16px;word-spacing:0.06px;}
        #t2w_1{left:397px;bottom:826px;letter-spacing:-0.19px;word-spacing:0.11px;}
        #t2x_1{left:81px;bottom:1004px;letter-spacing:-0.13px;word-spacing:0.07px;}
        #t2y_1{left:81px;bottom:945px;letter-spacing:-0.15px;word-spacing:0.07px;}
        #t2z_1{left:352px;bottom:925px;letter-spacing:-0.13px;word-spacing:0.08px;}
        #t30_1{left:704px;bottom:926px;letter-spacing:0.2px;word-spacing:-0.07px;}
        #t31_1{left:81px;bottom:885px;letter-spacing:-0.14px;word-spacing:0.07px;}
        #t32_1{left:81px;bottom:866px;letter-spacing:-0.16px;word-spacing:0.09px;}
        #t33_1{left:397px;bottom:866px;letter-spacing:-0.15px;word-spacing:0.09px;}
        #t34_1{left:397px;bottom:846px;letter-spacing:-0.18px;word-spacing:0.12px;}
        #t35_1{left:409px;bottom:975px;letter-spacing:-0.12px;word-spacing:0.08px;}
        #t36_1{left:81px;bottom:1064px;letter-spacing:-0.1px;word-spacing:0.07px;}
        #t37_1{left:397px;bottom:1064px;letter-spacing:-0.11px;word-spacing:0.07px;}
        #t38_1{left:81px;bottom:1084px;letter-spacing:-0.1px;word-spacing:0.06px;}
        #t39_1{left:397px;bottom:1084px;letter-spacing:-0.09px;word-spacing:0.05px;}
        #t3a_1{left:290px;bottom:1244px;letter-spacing:-0.16px;word-spacing:0.06px;}
        #t3b_1{left:81px;bottom:1204px;letter-spacing:-0.14px;word-spacing:0.06px;}
        #t3c_1{left:81px;bottom:1185px;letter-spacing:-0.2px;}
        #t3d_1{left:281px;bottom:1184px;letter-spacing:-0.13px;word-spacing:0.08px;}
        #t3e_1{left:662px;bottom:1184px;letter-spacing:-0.13px;}
        #t3f_1{left:81px;bottom:1165px;letter-spacing:-0.11px;}
        #t3g_1{left:282px;bottom:1164px;letter-spacing:-0.14px;word-spacing:0.08px;}
        #t3h_1{left:81px;bottom:1145px;letter-spacing:-0.11px;word-spacing:0.05px;}
        #t3i_1{left:218px;bottom:1144px;letter-spacing:-0.14px;word-spacing:0.08px;}
        #t3j_1{left:81px;bottom:1104px;letter-spacing:-0.13px;word-spacing:0.06px;}

        .s0{font-size:11px;font-family:sub_TimesNewRomanPSMT_lfr;color:#000;}
        .s1{font-size:14px;font-family:sub_TimesNewRomanPSMT_lfr;color:#000;}
        .s2{font-size:14px;font-family:sub_TimesNewRomanPS-BoldMT_lfb;color:#000;}
        .s3{font-size:12px;font-family:sub_TimesNewRomanPSMT_lfr;color:#000;}
        .s4{font-size:14px;font-family:TimesNewRomanPSMT_il;color:#000;}
        .s5{font-size:11px;font-family:sub_TimesNewRomanPS-BoldMT_lfb;color:#000;}
        .s6{font-size:14px;font-family:TimesNewRomanPSMT_il;color:#FFF;}
        .s7{font-size:12px;font-family:SymbolMT_ir;color:#000;}
        .s8{font-size:12px;font-family:sub_TimesNewRomanPS-BoldMT_lfb;color:#000;}

    </style>
    <!-- End inline CSS -->

    <!-- Begin page background -->
    <div id="pg1Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
    <div id="pg1" style="-webkit-user-select: none;"><object width="935" height="1540" data="{{ asset('/assets/img/1.svg') }}" type="image/svg+xml" id="pdf1" style="width:935px; height:1540px; -moz-transform:scale(1); z-index: 0;"></object></div>
    <!-- End page background -->

        <form method="post" action="/PrintPDF" class="needs-validation" enctype="multipart/form-data">
            @csrf
            <!-- Begin text definitions (Positioned/styled in CSS) -->

                {{-- HEADER --}}
                <div class="text-container"><span id="t1_1" class="t s0">ANAK LAMPIRAN 1.b </span>

                <span id="t2_1" class="t s0">PERATURAN BADAN KEPEGAWAIAN NEGARA </span>
                <span id="t3_1" class="t s0">REPUBLIK INDONESIA </span>
                <span id="t4_1" class="t s0">NOMOR 24 TAHUN 2017 </span>
                <span id="t5_1" class="t s0">TENTANG </span>
                <span id="t6_1" class="t s0">TATA CARA PEMBERIAN CUTI PEGAWAI NEGERI SIPIL </span>
                <span id="t7_1" class="t s1">Kepada </span>
                <span id="t8_1" class="t s1">Yth. </span><span id="t9_1" class="t s1">Bapak Kepala LPP RRI Palembang </span>
                <span id="ta_1" class="t s1">di </span>
                <span id="tb_1" class="t s1">Palembang </span>

                <span id="t3a_1" class="t s2">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI </span>

                <span id="t3b_1" class="t s2">I. DATA PEGAWAI </span>
                <span id="t3c_1" class="t s1">Nama </span><span id="t3d_1" class="t s2">Anne Marizka Putri, ST </span><span id="tc_1" class="t s1">NIP </span><span id="t3e_1" class="t s2">199306142022032010 </span>
                <span id="t3f_1" class="t s1">Jabatan </span><span id="t3g_1" class="t s2">Teknisi Siaran Pratama </span>
                <span id="td_1" class="t s1">Masa Kerja </span><span id="te_1" class="t s2">2 </span><span id="tf_1" class="t s3">Tahun </span><span id="tg_1" class="t s2">6 </span><span id="th_1" class="t s1">Bulan </span>
                <span id="t3h_1" class="t s1">Unit Kerja </span><span id="t3i_1" class="t s2">Lembaga Penyiaran Publik RRI Palembang </span>

                <span id="t3j_1" class="t s2">II. JENIS CUTI YANG DIAMBIL ** </span></div>
                <span id="t38_1" class="t s1">1. Cuti Tahunan </span><span id="t39_1" class="t s1">2. Cuti Besar </span>
                <span id="t36_1" class="t s1">3. Cuti Sakit </span><span id="t37_1" class="t s1">4. Cuti Melahirkan </span>
                <span id="t23_1" class="t s1">5. Cuti Karena Alasan Penting </span><span id="t24_1" class="t s1">6. Cuti di Luar Tanggungan Negara </span>
                <span id="ti_1" class="t s4">√ </span><span id="tj_1" class="t s1">x </span>
                <span id="tk_1" class="t s1">x </span><span id="tl_1" class="t s1">x </span>
                <span id="tm_1" class="t s1">x </span><span id="tn_1" class="t s1">x </span>
                <span id="tt_1" class="t s4">√ </span><span id="tu_1" class="t s1">x </span>

                <span id="t2x_1" class="t s2">III. ALASAN CUTI </span>
                <span id="t35_1" class="t s1">Urusan Keluarga </span>

                <span id="t2y_1" class="t s2">IV. LAMANYA CUTI </span>
                <span id="to_1" class="t s1">Selama </span><span id="tp_1" class="t s2">2 </span><span id="tq_1" class="t s1">Hari </span><span id="t2z_1" class="t s1">Mulai tanggal </span><span id="t30_1" class="t s8">26 April 2024 </span><span id="tr_1" class="t s5">25 April 2024 </span><span id="ts_1" class="t s1">s.d </span>
                <span id="t31_1" class="t s2">V. CATATAN CUTI*** </span>
                <span id="t32_1" class="t s1">1. CUTI TAHUNAN </span><span id="t33_1" class="t s1">2. CUTI BESAR </span>
                <span id="t34_1" class="t s1">3. CUTI SAKIT </span>
                <span id="t2w_1" class="t s1">4. CUTI MELAHIRKAN </span>
                <span id="t2e_1" class="t s1">5. CUTI KARENA ALASAN PENTING </span>
                <span id="tv_1" class="t s1">Tahun </span><span id="tw_1" class="t s2">JSC </span><span id="t25_1" class="t s2">16 </span><span id="tx_1" class="t s1">Sisa </span><span id="ty_1" class="t s1">Keterangan </span><span id="tz_1" class="t s1">x </span>
                <span id="t10_1" class="t s1">N-2 </span><span id="t11_1" class="t s1">0 </span><span id="t12_1" class="t s1">2022 </span><span id="t13_1" class="t s1">x </span>
                <span id="t14_1" class="t s1">N-1 </span><span id="t15_1" class="t s1">6 </span><span id="t16_1" class="t s1">2023 </span><span id="t17_1" class="t s1">x </span>
                <span id="t18_1" class="t s1">N </span><span id="t19_1" class="t s1">12 </span><span id="t1a_1" class="t s1">2024 </span><span id="t1b_1" class="t s1">6. CUTI DI LUAR TANGGUNGAN NEGARA </span><span id="t1c_1" class="t s1">x </span>

                <span id="t2v_1" class="t s2">VI. ALAMAT SELAMA MENJALANKAN CUTI </span><span id="t1d_1" class="t s1">TELP </span>
                <span id="t2c_1" class="t s1">Palembang </span>
                <span id="t2a_1" class="t s1">Hormat saya, </span>
                <span id="t2b_1" class="t s2">Anne Marizka Putri, ST </span>
                <span id="t2d_1" class="t s1">NIP. 199306142022032010 </span>

                <span id="t2h_1" class="t s2">VII. PERTIMBANGAN ATASAN LANGSUNG** </span>
                <span id="t1e_1" class="t s1">DISETUJUI </span><span id="t1f_1" class="t s6">√ </span><span id="t27_1" class="t s1">PERUBAHAN**** </span><span id="t28_1" class="t s1">DITANGGUHKAN**** </span><span id="t29_1" class="t s1">TIDAK DISETUJUI**** </span>
                <span id="t1g_1" class="t s4">√ </span><span id="t2l_1" class="t s1">x </span><span id="t2m_1" class="t s1">x </span><span id="t2n_1" class="t s1">x </span>
                <span id="t26_1" class="t s8">Teknisi Siaran Ahli Madya </span>
                <span id="t2s_1" class="t s1">Suryadi, S. I. Kom </span>
                <span id="t2t_1" class="t s1">NIP. </span><span id="t2u_1" class="t s1">19680920 199603 2 001 </span>

                <span id="t2r_1" class="t s2">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI** </span>
                <span id="t1h_1" class="t s1">DISETUJUI </span><span id="t1i_1" class="t s6">√ </span><span id="t2i_1" class="t s1">PERUBAHAN**** </span><span id="t2j_1" class="t s1">DITANGGUHKAN**** </span><span id="t2k_1" class="t s1">TIDAK DISETUJUI**** </span>
                <span id="t1j_1" class="t s4">√ </span><span id="t2o_1" class="t s1">x </span><span id="t2p_1" class="t s1">x </span><span id="t2q_1" class="t s1">x </span>
                <span id="t1k_1" class="t s2">Kepala RRI Palembang </span>
                <span id="t2f_1" class="t s2">Rahma Juwita, S.Sos, M.Si </span>
                <span id="t2g_1" class="t s1">NIP. 19720120 199403 2 001 </span>

                <span id="t1l_1" class="t s1">Catatan : </span>
                <span id="t1m_1" class="t s3">* </span><span id="t1n_1" class="t s3">Coret yang tidak perlu </span>
                <span id="t1o_1" class="t s3">** </span><span id="t1p_1" class="t s3">Pilih salah satu dengan memberi tanda centang (</span><span id="t1q_1" class="t s7">√) </span>
                <span id="t1r_1" class="t s3">*** </span><span id="t1s_1" class="t s3">diisi oleh pejabat yang menangani bidang kepegawaian sebelum PNS mengajukan cuti </span>
                <span id="t1t_1" class="t s3">**** </span><span id="t1u_1" class="t s3">diberi tanda centang (</span><span id="t1v_1" class="t s7">√</span><span id="t1w_1" class="t s3">) dan alasannya </span>
                <span id="t1x_1" class="t s3">N </span><span id="t1y_1" class="t s3">Cuti tahun berjalan </span>
                <span id="t1z_1" class="t s3">N-1 </span><span id="t20_1" class="t s3">Sisa cuti 1 tahun sebelumnya </span>
                <span id="t21_1" class="t s3">N-2 </span><span id="t22_1" class="t s3">Sisa cuti 2 tahun sebelumnya </span>

            </div>
            <!-- End text definitions -->
        </form>
    </div>
</body>
</html>

@endauth

@endsection