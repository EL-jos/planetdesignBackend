<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="assets/admin/img/apple-icon.png">
<link rel="icon" type="image/png" href="assets/admin/img/favicon.png">
<title>
    Material Dashboard 2 by Creative Tim
</title>
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- Nucleo Icons -->
<link href="{{ asset('assets/admin/css/nucleo-icons.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/nucleo-svg.css') }}" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<!-- CSS Files -->
<link id="pagestyle" href="{{ asset('assets/admin/css/material-dashboard.css') }}" rel="stylesheet" />
<!-- Nepcha Analytics (nepcha.com) -->
<!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
<script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<!-- FILEPOND -->
<link href="https://unpkg.com/filepond@4.26.0/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet"/>
<!-- SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- SORTABLE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<!-- AXIOS -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<style>
    .filepond--root.picture.filepond--hopper{
        width: 100%;
    }
    .el-container .el-remove{
        position: absolute;
        background: red;
        color: #F2F2F2;
        font-weight: bold;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        top: 0;
        right: 0;
    }
    #select2--container,
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        position: absolute;
        top: 50% !important;
        transform: translateY(-50%);
    }.select2-container--default .select2-selection--single,
     .select2-container,
     .ts-control{
         min-height: 40px!important;
     }.mb-3{
        width: 100%;
    }.el-container{
         position: relative;
         width: fit-content;
     }
    .filepond--list {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        height: 500px;
    }.filepond--item{
        width: 30% !important;
    }
</style>
