<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="developer" content="a2sys.co">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

  <title>
    @yield('title') | Admin Panel {{ env('APP_NAME') }}
  </title>

  {{--
  <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/w3.css') }}">

  {{--
  <link rel="stylesheet" href="{{asset('assets/sweetalert2/dist/sweetalert2.css')}}"> --}}

  <!-- SweetAlert2 -->
  {{--
  <link rel="stylesheet" href="{{ asset('cp/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> --}}

  {{-- <script src="{{asset('assets/sweetalert2/dist/sweetalert2.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('cp/dist/css/adminlte.min.css') }}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet">
  --}}


  {{--
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
  {{--
  <link rel="stylesheet" href="{{ asset('css/w3.css') }}"> --}}


  <meta name="csrf-token" content="{{ csrf_token() }}">


  <style>
    .nav-legacy.nav-sidebar .nav-item>.nav-link {

      border-top: 1px solid #dfdfdf !important;
    }
  </style>


  @stack('css')

  <style>
    footer {
      font-size: 9px;
      color: #f00;
      text-align: center;
    }

    .displayToggle {
      display: none;
    }
    .printFooter{
      display: none;
        }
    @page {
      size: A4;
      margin: 0mm 0mm 0mm 0mm;
      header:false;
      footer:false;
    }

    @media print {
      .btn, .badge , .fas {
        display: none;
      }
      .op-hide{
          display: none;
      }
      .op-show{
          display: block;
      }
      .printFooter{
        display: block;
      width: 100%; height: 20px;
      background-color: #00AAAD;
        }
      .watermarkOnPrint {
        min-height: 100vh;
      }

      .displayToggle {
        display: block;
      }

      img.printLogo {
        width: 300px !important;
      }

      .hrOne {
        margin: 0 !important;
        border-top: 1px solid #20B065 !important;
      }

      .hrTwo {
        margin: 3px 0 0 0 !important;
        border-top: 1px solid #B8DFA1 !important;
      }

      .firstHr {
        margin: 0 !important;
        border-top: 1px solid #00b7fa !important;
        text-align: center;
      }

      .mainContainer {
        background: linear-gradient(0deg, #fbfdfc, #d2f1e6 80%);
        width: 100%;
        /* height: 200px; */


      }
      .dd{
          display:block;
        }

    }


  </style>



</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm wrap">

  <div class="wrapper">


    @include('admin.layouts.adminHeader')

    @includeif('admin.layouts.adminLeftSidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="mainContainer displayToggle">
        <div class="container">
          <div class="row">
            <div class="col-4">
              <img class="printLogo" class="img-fluid" alt=""
                src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4QAiRXhpZgAATU0AKgAAAAgAAQESAAMAAAABAAEAAAAAAAD/2wBDAAIBAQIBAQICAgICAgICAwUDAwMDAwYEBAMFBwYHBwcGBwcICQsJCAgKCAcHCg0KCgsMDAwMBwkODw0MDgsMDAz/2wBDAQICAgMDAwYDAwYMCAcIDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAz/wAARCAD1AnUDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9oKdEMvTadD9+g+TLEiBWGABx6VJCcr+NKFyOlJJPHAmGR3z0VPlP50HTG9h1SQrlenemWYmUbmhjQn7uQ0o2++DjNSx9/v8AXndEY/yBJ496CtQ6S/hUkowR9KbjmgnNAahUkK5Xp3psQy9WJFCkYGOO1BvHYaBipIVyvTvRCuV6d6kAxQUAGKKKKACpIVyvTvUdSwfc/Gg2jsPAxRRUkK5Xp3oKCFcr071IBigDFFABRRUkK5Xp3oNo7BCuV6d6kAxQBiigoKKKKACipIVyvTvT9g9B+VADIVyvTvUgGKAMUUAFFFFABRQYmfpu/CgIU65/GgAooooADEz9N34Un2dvVqUMRS729TQA37O3q1H2dvVqdvb1NG9vU0AIEKdc/jRQTmigAoooMTP03fhQAUUBCnXP40UABXPak2D0H5UtFAEMww34U2rBXPak2D0H5UAQBiKCc06YYb8KbQAFc9qTYPQflS0UAQzDDfhTasFc9qhmGG/CgBtBXPaiigxluQzDDfhTasFc9qhmGG/Cgkgn+/8AhTKsFc9qhmGG/CgBtFFFBjLcCue1QzDDfhU1RT/f/CgkYVz2qGYYb8KmqKf7/wCFADKKKKDCV7jtoMXQdfSq5H7s/Wps8VFNw1BOpFExKn60ybhqlAxTtoMXQdfSgNSuEXyvujr6VVPWrf8AyyP1qoetBzT3CgrntTgP3X41HEcg/WgkjmGG/Ciln+/+FFAE8Qy9WJECsMADj0qvD9+sn4q/EXS/hJ4E1DxJrl3HY6TpNu91dyysERY4wGZw3XcnXZ/HuA5xXVCE69L2NFe82EYwjGVarsiv8V/jH4d+BngfUPEXirW7HQ9F0+MSTzXDDdjnhAfvMfQV+ZX7RH/Bcb4kftEeOZPBP7NXhO4mkvX8q21MafJq2pXXON8dquBCnTEkpMeQ3GQSeWi074h/8F8P2l763iuLvw78FPC820KUYwwRv/q2Yt9+4k5cHrGroBjFfrV+yP8Ase/D/wDZD8BLoPgnQbKxWMCO7u3US3l1IEVSZZiN752g8k4zX2WIoYDIYJ4m1es18K/5dvtLzPLoU8VmsuahL2dFd95ruj8rdJ/4Ja/tyfFW0bxBr/xd1Lw3qUgLf2efFF0tyCQCA0ULiBSxO0BAAu31zVr9ij/gpt8Sv2MP2im+C/7S1xqUdrcXEdvp+r6i7y3GmzZxGXlJP2i3bBLMxP3sHgCv2as7ZQjL+7URZEYA4j+np+FfKP8AwVb/AOCXuh/8FBfg5H9mNtpvjrQ7eYaRqQRRvDj5reQ9WRzxg8AknFcFPiJYuTw+KhFJ9Ukj0KmTRoQVbCXuujbZ75plzDeWMc1tN9ot5h5kUgcSB1b5shh95SSSvopA6AVYr8Lf2dv+Cw3xs/4JvK3wl8ceDbLxR/whkxspbO7uJ7TUbCNQAsaXTCWKSMKNy5hJG8jfgAL93fs0/wDBwF8CPjfcWtl4j1K7+HGtXjCCKLWdi20snHyi4G6LqcZKo3sBjOWM4Xr0Y+2pU3KD1T7oywedU6s+StpLqfdEA+X8akJzWf4U8SWXjDR477TbyG+sXUPFc2TRzxEnnqCd64wdw459q1Ld1nj3bFVv4iDkMfUDt9BXzM4yUrSVn2Pd5k9Y7Cwfc/Gn0AYoqQCiipIVyvTvQAQrlenepAMUAYooNo7EkK5Xp3qQDFMg+5+NPoKCiipIVyvTvQbR2CFcr071IBigDFFBQUUUUAFSQrleneiFcr071IBigAAxRRRQAUUUUAFFFSQrlenegCMMRQ0bSnOWqfYPQflSgYoAjhtWK/xdacIdnUfnTgxFDRtKc5agBNg9B+VGweg/Kj7O3q1H2dvVqADYPQflRsHoPyo+zt6tR9nb1agA2D0H5Uht9/T9KX7O3q1KoaIYy1AEM1swb+LpTVDRDGWqwTmgrntQBXJzRUxt9/T9Kjlj8psUANooooAKKKKAArntUMww34VNQVz2oAr0U6YYb8KbQAUFc9qKKAIZhhvwptWCue1QzDDfhQA2op/v/hUtBXPagxluV6Cue1OmGG/CgD91+NBJXmGG/Cm0rHJpKDGW4UFc9qKKCSGYYb8KaVz2q1tBi6Dr6VXI/dn60AV5hhvwptKxyaSgAp20GLoOvpTaM8UHPLchI/dn61HExKn61LNw1MAxQLUim4aoZVwnSrEw+WoohugbPPzd6BFWJiVP1pwGKCMGig55bkkSKy8qDz3FFRhiKKCSxbQ5njbgL5qI5PQZWTH5kfoK/LL/AILZfHbXvjx8fPCX7PPhQHULm7ltrrUbKJiEub1m8u3hkxwUXLMwPAMiv1XNfqi44WNYQ28Fyc8Eq0YGR3wruR6Yr8q/2GrC3+Lf/Bdzx9rXiaSO31DTb7UJdNhkQDeyL9lTaD3+zDfkf3j619ZwpSVOpiszlthqak/noeLxBN16EMtho67UV8tT9QP2If2VNB/ZD/Z20PwXo8SzLZRrJdXkiAzahcEDfNI3ViSMrnJVdo6AV65FaRQLtjjjReeFUAc81V8Oq404NJgSOQzAdiQMj8Dx9BV6vl61V1KkqzestW+9z7/D04xpRgl8KS+7Qj+yRE/6uPnr8o5oFrGAB5ceFOQNo4NSUVmb2R8C/wDBaP8A4JRaV+3J4IbxB4Vs7XTfihoNuHsp1/dR60oZ2FnNtxkuS2HbO38a/Jn9nr4bfD39o2+vPhv448P3XhH4m6bG1nHdWKizGriNiGj8nAVPLbeM9ZMZ5zX9KGrGQyssaRN8nzBx94c8V+bH/BaX/gkm/wC0Nbw/F74YQ/2b8UNDP2u/jgK2/wDbUcQJQhhg/aF6KScSKqo5KooH0WBzx4vAyyzEV3RSdoVNbxn006wex8vnORKd8TDT0Pz70X4NftEf8E39Wk8TfBnxpfavoFtITLBbui28i9D5tpLlZGGACsYDYAOeRX2x+wr/AMHEnhP4qahaeEPjHZQ+BfEnmCz/ALWEhXS7qXAx54wJLNyxICZ9CTggDwr9hz9t9f2hNHbQ9baOx8d6PEYr6B8Rrq0asU3wN1DB1dWUdGRscYrY/af/AGD/AAX+0lYXE81s2jeJ7dPJt9TsoEZizZOJkxiZPmwS2SmMjmvjcRxvPAY55TxnhVGonaNam7+kmvPc8DDYmrR96nqz9htG1GHVdOjnt7pL6CQBo51KFZVPIIKcEEEYPpirVfgZ+zl+3p8cv+CM3xM0zwd43huvF3wqklaOO1aZ7m1WPjc+m3bEu7KBuaKQhVz8o5r9r/2Yf2pPBv7YHwmsfGngPVrbXNFvBFInkOPNhJJDLKh+ZSOhU+melfQYjK3GmsVhqntKctYytbmXp0PosNjIV/4mkup6JUsH3PxptsmItrbmZWYEsoGeT0x2qUDFebG7XvbnpxikrIKkhXK9O9EK5Xp3qQDFUUAGKKKKACpYPufjSQrlenepAMUG0dgooooKCpIVyvTvRCuV6d6kAxQAAYooooAKKKKACpIVyvTvRCuV6d6kAxQAmweg/KlAxRRQbR2CiiigoKAxFFFAC729TRvb1NJRQAu9vU0b29TSUUALvb1NITmiigAoMTP03fhRQGIoAFDRDGWoYbjzz9aCc0GJn6bvwoAabff0/So5Y/KbFTKGiGMtQw3Hnn60GMtyvRTphhvwptBIUUUUABXPaoZhhvwqagrntQBXop0ww34U2gAqKf7/AOFS0Fc9qAIQP3X41HEcg/WpZuGpgGKDGW4Fc9qim4apain+/wDhQSR7R6D8qimGG/CpqdtBi6Dr6UAVaKD1ooMZbhniopuGqWmTD5aCSHaPQflUUww34VNFzC3+9UDHJoASiiigwle4yYfLUERyD9atEZqGVQrcDH0oJ1GkZqGUbTgcD2qaop/v/hQGpWmGG/CgD91+NWNoMXQdfSqxNBzT3GRHIP1opwGKKCS1lWu13NtkhUPFtX5mJyGBP90jt0r8xv8Agrd+y/r37K3xfh/aY+GerSaTcWN7BJq0AJBidy0bHj70cibI9vQbD61+m7ybFzk18b/8F1fF7eG/2C722w27VtXsbeLZwTtnR2U/7JQMMdPmPqa+o4PrOeY0sM/4dZunNdGlrqeXxLRUcvq4in8UYpryd+nY9l/4Jvf8FIvDv7cvwthkjkj0jxppuYtX0l5vmV+G8xfVWDjn1yO1fUsNwsExjbzTsOMlic96/m18FXXir9hy/wDhn8SfAGoXX9s6tpZudWtzB5kLQ27v5ocdZFfoFOQrAt1Jr9yf2A/2+PB/7dvwjs/EHh26ij1SCNTqelNMRcWExVWZXB5K4ZSO2DjtS4qySlTn9ayl81Nt38rOx6PDXE8cWvq0/iil+SPoVpY5LhvnlX5OgJHrVG41H7KPlkmC/Ll2JbdkkbQPX396klvvNv2WNtrQ/fDLxICOADXx7/wVZ/4Ke6J/wT/+GQtLGSHVPiNrkLjQtJ3F1jYfeu7kr8yww5BIHzOSAM4NfMYWnXxNeNPCq8XufT4rELDQ9ozr/wBv7/gpR8Of2CfDxu/Emrz3niCZdmm6DZN9our1wCTkL/qwc4LS5QbQQM5z+esnxD/bU/4LO37T+F43+C/wnugy2t1FJInmRHh0a6XbJNuGMhcR9gODXV/8E5v+CSPib9pT4it8fv2l5LjxBq2pzi8sNBv22rMrBWjnuEGQq5ZikGNqoEYgO71+i37Qf7Ufw1/Ye+Hh1Px14mtPCOj2saJbqzqDejtHBGuWYDptQBuPTFfRYiGHwVRUcPT9pU63V1c8OnJ47mqVm1A/Ez9v7/gkL4w/4Ji/DPRPi5Y/Ey313VLfUorfyvspjbzWyTtfqVOxMnqVDg8V9W/Bbx03xM+EnhnxJ5H2Vtc06DUBGP8Aln5iBhgdjgjPvmvnH/grR/wUs1j/AIKsQ6X4B+EPgrx5rvhrw7cTalfT2WmXk82pN5YiiMcEKFlQq8v+sbd9/IxjL/2Jf21bbz9L+D/i7S73wn400XydJtra8t/JF/5QyIm3opgfyyjEnltw5PQfM+LHDuPx3D2GzOjT5MRRnUlWlH3qipWVrw7edtDwakcNTxkfq9JpW+J7PzPor4s/DDQfi94NutD8R6bBq2l32Fe3cBdrdpPN+9CR1DJguRg8AV8RaH4t+KX/AARN/aWXxL4SvLrX/h7rl1519YXCELq0fAaOZB8kcyIqkPjLKU5zX6AQHzbfdtmWGV2ZEl+8oDFcH6EH8MVjfEv4caJ8VvBd94e8S6eNU0PW0aK7txgyyIoBYxE/6uVcqVYYJ5HavwjgPxCxOQYhZdUTrYaXxwk37yfVP7Mlu0rGMq1RVVVpatbn3X+yR+1d4V/bV+BOjeOvBN5I+n6gschgUqzabOOWt51+8M7vx4NeqWgVEcR+Y0e9ijO5ZmycnOemGLADsAK/ns/Zk+M3ir/ghv8Att28mr3dzqnwj8WXK/2w8KFkmtRxBdKOiy24xvXq/fNfv/8ADrx7pPxP8E6br+h6hbapperQrdW9xBMJUdJBvB3epDBiP4S2O1f0HjsHQUIYzCVvbUZq8bb2fT1W3yPrsFjIYyLlPSS3N63bcn41JTIPufjSk/vfwrljJSV4rlXZ9Doi01eOw6pIVyvTvTZRgj6U+D7n41R0R2HgYooooKCpIVyvTvUdSwfc/GgB4GKKKKACiiigAqSFcr070QrlenepAMUAAGKKKKDaOwUUUUFBRRRQAUVJFD5i5pwi2UAQ0VPsHoPyo2D0H5UAQUVPsHoPyo2D0H5UAQUVPsHoPypDBvoAhop0qeW2KbQAUBiKKKAAnNFFFAAVz2qGYYb8KmoK57UGMtyvRTphhvwptBIUUUUABXPaoZhhvwqaop/v/hQAykY4Hf8ACjDFtq+ZvcYGFBA/OsjxT440rwNpklxq2qWtnDCP3k0zooHtioqTpwXNV2OWpam+eU/Z+b2NRuY+h696gjjaQE5brivnj4n/APBUH4ZeBI/L0vUL3xRf52tDp8G5V+pbgfUV86/EH/grX4u1ySaHw3o+l6LGJTtkkkluJAvqxJ2Kf9kg4xnvXjYjPsBQ+0fO5lxhlWET9pWVVrdR/wCAfohMWt1J3L0yd7hQB+Ncn40+OHhPwBC0mreIdJs1UZYNew5H4EFq/Krxz+1Z8SPifcs2peMdcu4GkJeGzdIUVf7u+Pbx1+U+vvXAXs/9o38jSzrIGbdkks4PoSeSa+dxfHlCnpQpuXmfD4vxSw8bvDUWfqF4r/4KP/CHw3EWj8Qzaww52afFJcHPplcD8Pf3ride/wCCuHgm0i3RaD4snhx8oW0jhz75eVW/TH61+dd7eN5qjfKsyjCq0gGV9eQfepIJklwy+THJ0J8w7vyUBfz5rw8Rx1j6qtCFj5nFeJWbVv4LhFdE4tterPuq6/4LDaTHCfs/gvUJI93DSX8UbfiNz/z/AA9ar/8ABYW1kxs8F3SjHfU4v8K+ISrY/eTSNnnkbaaQB0bdWMOLM25VaSRwx46z63xx+SsvuPujTv8AgsBpbP8A6Z4M1JUzy0V5DJj/AMiJ/L8fTqNB/wCCsvw/vXZr7SvEemwEbTN9k+0xq3vskbHX1r878fNu/i9aNx8zf/Fjbu749KKfGWZ053krnRh/ELOKbvOaP1a8D/tpfDTxxJCtr4r0+1muBlI7lHiZx64c4Hp+FelW2o22sW32izumvIW4DW/lupPrkc+lfiw1vG64aNGGc4K966fwB8aPFXwt1WGbw/4i1HSZlOUSCRpFJ/2oidm3jrjPHtXvYTj6L0xNJ36nuYLxQbl/t9JJfzQd2/O3Q/YKJiwOXV+f4Rjb7H3p1fD/AMFf+Cq95DcrYePNNSeIsFk1izY/uSMZZo+57lRx0r7A+H3xR0L4weHF1bw9qq6hZzn5Z4ETg4GS0fVevTFfXZVnGHxqboVEm+j6H6Nk/EGX5tTvha238ys/mu50FRT/AH/wqdVVYPl2se7hshz6+30qA8xn616ajKKtJ3fc9RXS3v5jKZMPlp8XMLf71Nj+ZTnnmmPUhiOYG/3qrnrV2RQsfAxz2qketBzT3CipIVyvTvRQSWIlDJyM818F/wDBwj9oX9kbw/JDuWFfEMXmbTjP7t+D+lfe6jAr46/4LqeDW8Sf8E/9UuoFZ5tH1O0uSOyhriFM/kWH0JHevoOE4KWY0oVdH7RcvzX6nn8SQcsrxWGW7jGX4nxD8PJ1k8QfAMSRwXFvqWjXlmIpAAAxQSFc/wDTQBxjuc+tYviDRPF3/BNf9omx+MHwuuNSvfCM0q/21prZwYJXZ/s0o6Nu3FUZsiLYMYzXO6v4mGnfse/CHxvasbpvBerBbsg5CBpCoz7qGOPQGvsTWLPT/iLoc2n3UNvq2h6raiMoxBWSJ41JL54Yc4AP92vz3OuIMfw1mVDFVX7TDzqVlUj2UHqrfM+WwcZ1kqeGVpNKWnkkfZngH/god8PPiV+yDP8AGSx1ZZfDGmaXNe6hFJIEubKZQNtuUzkPuyinHO3I61+ef/BLT4Gax/wU9/bM8S/tHfFCNr/w/oGor/Ydq8e61lnhCyRBUbK7YlmBGBxIZCMEk18aftTfBnxd+yHp2u6PofiDVF+Hfji5t3MUZfy4pYnJRLhAdrsu1AjMDgSYGBX69/8ABNT44fCD4Bf8E7PhrBa+PvCejWtjoVtfXyXGoRpcR3MqCW6Lwg72O9mHfkeor9OwtTDYfIZZtkH7yFeVlHdxUtbX6H0tDNFmM4/WHbk3PU/+Ci37dug/8E9PgK/i7UU+1alfsbXRtKiYJ9rupCSGkI+ZIo8bnK9d2DX5kfBb9lm+/bB0q+/am/bC8YzeGfAcbtc6Fo8twbT7cgY/ukyfMMDktsSPa7ktn5SKtalq1p/wWf8A+CuTTXV80/wY+FsL6jvdZYbe6sI3AyfMOF86eYJgYBSJ2x8prN1+417/AILs/t0t4c0+8m8O/s+fDB8TbF8mN7CFniQjOEEtwkeS/wB6KMR4I4r38sy1ZfRitY1UuetJ6+zpy2SvvN9uh3VMRRr1pNuyj8KWzL1j/wAFB/i1+0Tr918Nv2LPhBb+BvCVjNj+2rXTUtZoUK7S80kkDxwDac4B8zDbifmFeC/ttf8ABNL4gfs/+HLj4i/Ef41/DzUPHhdLuXTf7VnuNW1NV++UdgPmjAUI4HUMoxivoL4oftu+LPid45tv2bP2H/D40rwzppOn3evaVDt+2xIzI8gucBkhQgqZid7uj8kAV6b8J/8Ag2W8O65pM2qfFr4meIPF3jPUS9xMNNuAkCTrHkKzyZZsHOSeuB9a2p4/D4Cp7XEtYaE1yvlfPKrF/wA172v2MpRq46LtCUnHo1yxXkn2PLP2BP2vn/ai+EEy6isUfi7Qoxa6k4RUW/3hRDcxqPugoFUnqXjkPUmvoBlX7U8iDHzIVPugABH0bcfqT618E/sOeALP4B/8FPPip4M0C+uNW8NeFRf2cE8gSUXyW2opHamRkG1yySStzk8V95wDYnlqxkhj+WJycmROob8cmv448XcmoZLxdWqZVF+yjGnVafRSi+nQ87D03TlyOKjbondL5nB/tI/APRf2kPhBqnhXVGjt1ldL2C7EQLaXMhcpKOPmDuQXA6pCynhznzL/AIN5f239c+AXxl1r9l74g3UliJZb2bw/FMzbdJvbd2N1aKxPzRyxCSWADglAB96vo5bYXLxsxZVtyWBXhmzgFfocDivhP/gqn8L9S+FHj3wj8cPAby2OueG720NzLDAJJLS4glUadJsPDJvkePno62wOFr6TwZ4goVMW+GsXL93iI2g+01rZdvkd1Gp7Kspdz+hLTQEidFZysTmMB8ll2/Lgk8sQQfmPXrVjHNfjb4J/4OltQbT7U3vwn0qS2ZQyLaa8Q8SHkKQ49Dkf7JXvmvV/hx/wc9/DXW9Q8nxR4B8WaDDgES2Ukd8QfU9Bt/Wv3iXCOdqHtJYdv/gaH0ksRRk7n6dk5p8J+avnr9nL/gqJ8Cv2qJI7fwr8QNFk1Fl3Np19MbOdG9GLYGenA4r6Fs5UuIFkj5ST5lIYMpH+yw6j3rw69HFYduOIhy26HZTacU47E8owR9KbQTmpIVyvTvXLzKWqKCFcr071IBigDFFABjmiivJ/22v2hLr9lX9mDxn8QrSwXU7jwvYrcxWrnak7GRVIJ9h/Opp03XqKh9r7PmHLyPnZ6weKAcivxlT/AIOmPEztJt+FGitH5jBCNTf5hk//AKvwoX/g6K8TXd5CrfC3SIEdvmddTdmRVIY/L06A19RHgbPIyVWtDRIwji1Obgj9n4PufjT6oeGbmS+0SC4mjaGW6XzmjZt3l7udo9gDV+vl6cZRXLPc7YxsrBRRRVFBRUkK5Xp3p+weg/KgBkK5Xp3p+weg/KlAxRQBHKdjfLxx2phdj/E3506f7/4V8Y/8Fcv+CoGpf8E2tJ8G3GmeFrXxVN4snntmhlu2gMQRQdwI+vXrV4fD1cRWVCjuzGVT2b5mfZYZgPvH86kjOV+9X4sn/g6e8QiRlT4XaXsXAH/Exc9h37855r3j/gm9/wAF2Na/bo/ahs/AV94H03w/aXFlLeG9S/eRx5QyyhOnQjmvocVwbmmFpOtWjaKJp4qjVla+p+lsjYbgmljJZOveorMgx9WdWO5Wb+IHnj25x+FeNf8ABQb9pq9/Y5/Zc8T/ABG0/S/7XufDdusqWjSeXHOWkRcH6D+dfL0faYicaNL4mb8qg7ntDllPWjzGH8TfnX4u/wDEUv4qSaZW+FOj/LIwB/tV2yM5/DrjHtR/xFMeKP8AolOkf+DN6+uh4f504pqDIeMop2bP2gLFutFfi/8A8RTHij/olOkf+DN6P+IpjxR/0SnSP/Bm9V/xD/O/5GT9dodz9oKK/F//AIimPFH/AESnR/8AwZvQf+DqHxTFx/wqbR275OpNR/xD/O/5GYyxFBu9z9oKK/F//iKl8Vf9Ek0X/wAGTUf8RUvir/okmi/+DJqP+If53/IyfbUe5+0GKM1+Lrf8HUHiVz8/wo0VT6f2rIv8qu6D/wAHVWoW98q6p8Ibe6gbqtlrYWRR6/ODTqcC51GFvZ/kL6xHpsfshN978KZX57/s7f8ABxf8Gfi3qsdh4o/tbwPeXThYhfqklqo4481BndkkYPYD1r7v8HePNG+I+hWusaHqlrqmm3yrNbyW0quGGP8AZP3fY187mOU43L2o4mNjZVPaLlRs1HMxDfhUV7cfYkdpHjKH5nLPsWL3z6e31r52+Pv/AAUd8D/BaWextrq48RaxF8otbTBjDcjmT8Oma8fF42lhY81Z6HFmGZUMvp8+IqqK8z6Inu1giJklWP0ZjhVPqT6V5H8dP24Ph78ArDfq2uQ3t+v/AC72TeduPIxxnHSvgX44ft7/ABG+Nt1NZx6vdaDpcv8Aq9P0RxJcTZJ+V8fvDnpjOOPXNcdpP7M+sw6T/wAJF4uv9F+HOi3HztqniKZrZn7lhEzGQk/3hwTx1Br5qXEU8bL2OV0nOR+c47xAq4qp9WyPDOtJ7zXwx82e3/Gb/grD408bSGHwdpdj4btm3bbqSFrm7ZefmAb92qn3GQQa+a9a8YeKfjNqaTahea54q1Gb5mRpTcE8ngBfkQdfl7Zz3rP8W/tn/sy/AXzI9PfxR8cPEVqMmDT0FjpO/p80xwxPGSPQrX2Z/wAETv2vof21/B/jbUJvA/hfwfD4a1S0s7G00cB9kTozP50hGS4+XPbG2u6vwPxBWwX9q5jFwpp2sefLhPPc3rJZvilKC6R0/I8I+HP7AvxW+JKecvh1dJsZuFm1e9WGFB7RqN569Qcfka9s8E/8EdLwpDJ4i8VRiXHzR2WlyRoF9BIzEHvyRX3zp5kgtQrHbJ0cKfl44GPquD+NP2KB90flU0eEcBSfvxcj6TB+G2S4ap7kG2fLXhr/AIJV/DfSrZWvjrGrSo2N0uoZTHHG1MLjvzzz9K73Sv2D/hPo8cat4K0m6ZRxJOiyEe3IP+TXskreX8o+VeuB0qNt38OM16VPK8HR+Chp6H0UchyzD/DQu/Q4fR/2Yvh1po/0fwh4fXb02afnH4qAKTUP2bvAd+jLN4O8O+WTyG0xsmu4ALEM3LdM1HcIrSZKqTjqRXVHL6MlzRgl8kdUMHhmrqkl5WR5Pq/7Fnwp1OIRt4F0HEjfM8dpJDJ+BXFed/EH/glt8LfEEDNp9vq/hu43YEsN9Js/8jFkP0254r6aMKNHyq8Hjiq4XZJuX5W9Rwazr5TgqitKlr3SOfF5LhcTHkq4anNeTs/nY/PX4qf8Ep/F3hlbibwrq1r4ljVOLW5tvstz35Uj5XGMfMMAnI7V81+Lvh9rnw61SSw1rRNU0+9hXHk3MW1XbJGQ/ccYx7V+z0Y8o5Xhs7iR1J9a5v4k/CPw58WNFaz8RabZahbS5UrdRDaT/sSY3I/uMdq+dzDg6hVj+40fY+AzzwxweKTnl1N0ZLo3dI/GvduVd3EgGHUDGw+nv2o3HYy/wt1HY19V/tT/APBM7V/h1Fda74KN9r2kw5eXSjj7ZYIMktE5/wCPgAYzvzgdOa+VWAz8oIjJO3rjA4OC3zHkEHPOQR0Ar8+xmW4nCTdKotIn5Jm2R1ssqcmPg2/syWil5grsvl4JHk8pj+D6elb3ws+LPiD4K+LzrnhnUGsbq3VXu1jztaMk/wCuH8SMQRxkggmsCkKgyRvgb4SWjbuhPBIPb8K8yNarTqxqUtEux5uGliKVf6y6nJJbR/z7n6g/softi6L+0foP2Ywx6brlmoa60zz8YXAIkhk6yKWzwTngj0r2WN/N3biGkB+chdqsfZewxj8c1+Nng/xRqHgjxPZ6xpd1Ja6lpb+daOshT5+4yPWv01/ZD/ao0/8AaT8DLcTSeRr2jjZqlsT89w20EOntk8/Sv1jh3iTDYqHs8U7Sjt5n7nwfxdSzKP8AZ+Pdq26tpex63KNpwOB7U0DFAWRBtlYNN/y0K/dz149sY/HNFfVQlKSvLc+9dWVT32iOc/N+FQSrhOlWJh8tRRDdA2efm71RJVidsHk9aKcRg0UHPLc0K81/bF+Ei/Hb9lvx34T2qZNY0W5WEkZ2TIoeJh6MGGQeoPIr0gn97+FSTwCaNw0alfKZD82BsYfOxHttQA9t59a7MHiPYzhX6xkjXFRVX9y95Rsfg1+xRYRfFn9mvx58K9Yiitbq3cptOB5bFPKaQL/eWSKM7uuZSepNewfsAfE+T4l/AWDS9SMa+JPCsyaVqVtKv7z9y5jJOevzA8nvXHftdfD1f+Cdv/BUNtQktXh8E+OHF/GCnyiCfCyRntmO4BbHb5D2FUPildSfsb/td6Z41TdJ4T8cFYtVaEboVly2+UgcEk+XNz1Kzd5Gzx+I2S/XK9WlF2p46LqU59I1aa5alL1qRd/Nn5thYyoVo0k9YaH1H418GaR8QvCt1pOvW0Oo2uoSFJY7uQqJirAqUbqsgIGG7bV9BXzHrf8AwR7+H9xd3S2+u+LNNt5pG8u2ZIPLtWbkkuwLOBgEOeefavrOGRXgVo3hkhkB2vE+9X5O7nuA+4A91APekWNVVgFUBl2kAdR6fSv5lyPjfOuGo4jD5fiatCnFJSprllGVnbrfl0PexFOjW1WjfY/N34PftPXH7EnwS/aF+GF9Z3Fr4t8cLa6Zp+pLtXFtH9oimzsA6287YPrN717h448ZSfsZf8Eafhz4J8M3Kjxt+0bPNquoy28m6T7CxjEMYA5DPFDawsO7GUHqa9W/ah/Yv8K/tO2T3N9bGw8SeS0Vtq9soMhIwVSfPPlAhTu65H+yK/Pn4iQ/Fb9nf4k+B4/F1jeXknwxuIpPDk97bs+jyRw3JulCsmW2NMicH1k9TX9scEcaZZxRgqc48lCrze/TqT96rNRXJL0fbYyoylR9rGt8CgrP5n77f8Etf2BvDv7Cn7OFvoclrbz+MtejW68S6nIm6a4lcK6QrkZ8uNNiBegZWxXG/wDBYX/gqHof7AvwYvrfTLqG5+IHiC1kg03TRLuFkSCn2qYLygTnao5kJIOQK+I9Q/4OAfj98c9FHh34XfC2PStS1Ym2t9UiiuL14nwFDoJPkZ3POHGQSWPLZrm/ht/wSm+JkXjmP4sftFNqera7POt15N3dLdLbTj5k+0OnKuNxITooIx1NfN5th8NhFVx2dYhcsLycadpc0r6U79Gna59fWzuE8N7DCwcrJa/Ik/4Jifs8ar8J/h7qXjDxI00fi7xnLFc3ME4xJbwu3mKHHQSMSZAB0R0HavpqIRrCqwrshXKxrjGFBIA/StDwN4FvvH2r2+k6PA0k0zbo0hQfZoT/AHgeoH9c10nxT/Z28T/Bq0tpNbht1tbtjFHPbSF0ikHzFnJ6BsgAdMg+tfyjxNj814hxdfNK0eVSeyd1yrRK/VJHi4bC4iVD2zja3Q44OR3PrXHftCfCqz+N/wAFfEnhm8ZV/tXTrm2ikdd6wTPExilIPVEkjjdh3CKp+8K66AloVc8eZztPVO2D+WfxokufIPK+Ysg+zsn95XZZcH2LW6DH0r5HK8ZUwkp5hT0lS5ZQ/wCviei+aMYVHUipyPw3g0rUPBGva94Z1HzI9Q0G+uLW5iLk+RNHPJHMg9hKkgHqMHvVsgo7Y4Vm3ADoOBXof7dvw3k+GX7dviqC1tru7j8TyHU4oY4zPLOb4lyRGmJDsm81Qc4G0gDg15/MrWV3Nb4t5Lq2URPboJvtEbLwUZZQAH7kHJ5HNf6ycK59RzPK8PiVJ+/CLevWyv8Ajc9jB603cLaYLcNJ5haa3XeETibnoVb1zX2R+w9/wW3+MH7Hc1npuuapfeOvCFsAr6Tqzsb2CM4GLeQkksAOFPHfvXxm0v2qBVfy+OTHjmNvRh03f/WoLbi2ed5y3+19a9LF5Pl+KhKli6V0+v6nRhazp6s/qI/Yq/b2+H/7cvw7XV/BupstzGii80u6dRf2UmAzK6nvhhyOP1r3KKUSbtvmBd2PnXHYV/J7+z38f/Gf7NHxIs/FPgXWLjRdbtWUI65+z3SKctBMoOHVgcANkKST3r+hn/gmj/wU08L/ALf/AMPDNFL/AGL4s0tfK1rQpm/e27KinMRB+YFmJ3D1x/Dx+AcY8FSy2ftMKn7Pp6HrKv7ZaH1cpyKWo7SXzYRzuxwT2NOJ/e/hXxEL8vvbm0Y8qsx1fNf/AAWAjV/+Ca3xdYqpZNDZlJH3T5icivpaUYI+lfNf/BX/AP5Rq/Fz/sCN/wCjErowP++Un/eX5k1n7p/MnKoG1ccLnA9OSak05FbVLYFRhiVIx1B2gj8QSPoTUc3+ub61Jpn/ACFbX/eP81r+uMRJuhK/8n6Hiy0rKx/Xd4M58Lae38T2sJY92Plrya1Ky/Bf/Ip6b/16Q/8Aota1K/kfEfxZep9KtgqSFcr071HUsH3PxrEY8DFFFFABRRRQAzG64/4DX5Ef8HWLEeEvhCO32zUTj38qOv14H/Hz/wAB/rX5D/8AB1l/yKnwh/6/NR/9FR19RwHrxBhU/wCZ/kc9TWEj8aY2MaKq/KqquAOg+UGvu7/g3SG//gpbom75t2jagpz3HlrxXwgv/sqf+grX3f8A8G6H/KSzQ/8AsD6h/wCi1r9z40k/7LxX+D9Tw8P/ABon9DVggWPAAA46D/ZWvkX/AILtjH/BMz4iN/ELe3we4zdQA/oSPxr66sfufl/Ja+Rv+C7n/KMn4i/9cLf/ANK7ev52yfTG0Wu6PerbSP5r87nYnknB5+gNLikH3j9F/wDQRU+n2UupXcdrbwyXFxeypHDFGpkkkk+ZUREX5juaQdDztHpX9eScOVyqOyjb8keEtUQ4oxXYSfAHx9wF8C+NljyzIR4Zv1yGYvzmN843bQQQMKBgY5Z/woDx9/0I/jj/AMJy9/8AjFefTx1KceaDjbzqRX4PYX7zojksUYrrf+FAePv+hH8cf+E5e/8AxilX4DePYxg+B/G/4+G73/4xV/Wod4/+DYher2ORxRiuv/4UT48/6Efxt/4Td7/8Yo/4UT48/wChH8bf+E3e/wDxij61DvH/AMGxC9XscirFRwSPpSmRiMbmx6Zrqn+BfjrO3/hCPGh8wYdRoc8cpH8IQPGpBJyMgfjxX1R+zH/wR91jxT4YtfGPxs1ZvhX4JmHmLZMofXr8DBEaxD/Vqf7/AN7O4dhXkZtxFl+W0HisdXiorpCSlJetupliKrjHnqyVJLq9j5T+Enwa8VfHrxpZ+G/COj32uapeMVEFtCZBHnADSMfkRPViR0+Z4hgt+uH/AATx+El9/wAEjfDt1cePfiVe614m1qHP/CAaJIZ9O06UgYlllJwspAAKgYCqhBYHe2b4U+J+n/Drw8Ph58AfCDeEdNvkSO6u9Nt/tOva1yVBmmxlc4HVuOam8d/CLwJ+y3oh8SfHrxsml3tziaPwvpcq3euXpI+67ZOwnHJzmv5w4s8S8TxJU+p8P4d1Kd7czXvNd2fKYriLGY2o8LlMFX6Oreyh5q25pfGP9tv4oftS+I/7F0ma8tbKb9zHpnh1WkmlG4/6wngg5wR7V3XwI/4JS+LPHMS33i69Xw3YM3mG3RC90wwDln3YQnptxxjPevjnU/8Agqz4B8c/tC+ANL8P+EdZ+F3wr0LVfJvtR0rWLu11i6SRGBlnlt3VmCbBJtJP3CP46/bP4cfDjRtLubPXLK6vr6a4s4Et7m+1i5u3li8tSpBldt2QeTn5juJ5Jr47FcC18Dy1swuufWzb0Nsu4F+sVPb5zXdWS2eyl8tvI5L4Kfsh/D/4H6Y02j6XZSahHuzqFwsd5I5wv8W3K+uO2fevxt/4OU5Wl/4KJWduystvD4P0sxxFt0YzeX2Sq9Fz6D0r99J+baUtuLhWBJH06e1fgP8A8HLnyf8ABR6Hb8v/ABRWnHj1+13vNfpXhfg8PDNYwpxVlGfRdkfbPC0sJQ5MNFRXkrX9bHwDNCl1IqyIsigvgMNwGCcV+1f/AAa3/vfgB8TC3zH+17RMnn5TEcj6e1fipbtm4P1b/wBBFftV/wAGt/H7PfxM/wCw1Z/+izX614lO2Syituanp8jmwaSs0fqRBxbx/wC4P5U6mw/8esP+4KkA/dfjX84qT/P8z2Yt7kUw+WoouYW/3qmj+ZTnnmo5RtOBwPaq5n3HdkcRyD9ak2gxdB19KaBijPFK7MJblc9acEXyvujr6UTDDfhTc8U+ZmfJFPmS1K561JG7RRsVJUt8pIOMj0psww34U3PFT5kylK9rla6z9nw21IGOyRnXzI2X+6U6d8/jXyH+3b+wTb+LNOuPF3gexEeswkz3lkgEaaog5JXGNrj16kADsK+xQMVDOjTpNErR42KxiZM7wCc1w5hg6FehKnLdni5zl1HHYd0Ky9H29D8TWVxLI0ivG7MdysuwqRwRt/hwRjHtnvRX1b/wUr/Zbh+G/iz/AIT7RbVl0jXZv+JlCo/1E3TzPZSNo/4Ca+VJQqtx97+L0z7fhivxXNMDXwFX2Ml7vQ/m/Oclng8x/s3EbW5oPq0NZQ64YbgDkA123wB+Neo/An4nab4gsZH22sirdx7yBPATgqR3xycH1riaTEL71lDklfk29Qa5adaph17WK+GR5NDG1qM44uHxqR+yPhTxZYeOvDtnrGlzLNp+pRLPBg/cBHK/gc1oV8n/APBLj43f8JF4L1bwlfOi3Wjj7RZpn70TBV2AeoKsePWvrQpsgXb/AKvAKE/eI9/fOa/eMFilj8NCvT+Kyuf09l2OljcLTqy0ckhu3MXTvVfGIm+tTRHMDf71RH/Vt9a6vefxbnpxi4qxUPWig9aKDCe5eP8Arvwqd4I5lO5Fbcuw5GcrkHH0yAcewqLHNTQnK/jR5HTre58i/wDBZr9ilf2vv2W7q70u3Mni7wWJ9Us2RP3tzAQvnwhuu5gilR6ivzw/Zy8S2/7X37M2s/D3xRiz8VeH0S3gDt+98xuIJVzzuiIPmMOeRmv3J+9Pj723axTONwBNfjz/AMFX/wBjLWv2HP2hbD46fDWzaw8K6heOdXCReZDpl1LuK7ohw1tMA6yIRtLbCQTivpKeHjnuWf2BWmoSpy9rQqPaNVbp+q0PkOIMr55Ku9L/AB26Q6P59zg/2Gv2gNV8Ea3efCHx40Wn65o7fZtJvZzsik8vCBDnqCqgqOmGGK+tGbzJXfZ5Yc5CZzt4AP6gn8a+Tf2gfhDo/wC3X8JtH+IngORtP8TrCTapIwaa5dUV3t3cfOLlQVMbMeAVUH5cDS/Yu/boX4g30fgnx+sej+OLVPIhWcmBb141C4nc8JKFUZA+8eepNfinHXCss3oVeIcvpqliIv2eIpSVppLT2sIfahLdOx5uDxXTG6fy+a6H1Ayhuozg5Ge1Q3FhBdpIssMMizcOHQMH4I59eCR+Jp1pIs9pHJG5ljlG5ZCMb+SM47cgj8M96kr8DoUXg5KVO6cdn1Xz3R7UU5QtM6z9nfXdL+H3xl0XVr2GOG1t5XZ2VABuYAEmvqP9pP40+F5fg9qttDqVvcXmpQBLZLcgNGMk446d6+MGG9NrfMvXB6U0QqHDbV3L0OORX1eA4yqUMHPCy15tdddX19fM9TB5hPD03Tit9j0D9mP4s6f8JPiQt/q1uv8AZs8CwTSRpmVBk7cd+CSTjsa9Y/a5/aP8N+OPAknh3RLj+05L513uyfukUcgAHjj+dec/s1fs7L8adWuLy81BdP03TD84jePzrpiOUXcCV4x8w9cdqj/ad/Z7h+A2r6e1rc3k+m6oxS3ilMfnWknJKFowAy4wcnn5jXqYWtmWFyCVRw9yWzt0Or2uJjl8p1Nm/wADzFU2vI25n3tksTndgAf0p23DhsfMCGB7gjofwpsZ4K/3SVx2H09qdXwMpOWslvrbzPGck9Yn56/8FkNKl8D/AB3+FHjqCFZmtXC4K5zLa3S3Ea/8D86UH159TX7q/EL9lD4R/tV/DPSZvFHgbwp4k0m906Ge1ku7KJXWORd6PHKF3hiGB4Pf3r8X/wDgt9o/mfAHwnq0X/HxpfiADI6jfbTbTn2ZMj3FftD/AME9fE3/AAmX7C3wZ1TcWa48F6V8xOTlbSNDz9Vr+vOEMyqvhXAV4Sa5JODs2j2sn63Pzt/be/4NurG1tbjXvgjrU0V4tvNcnw3q8hlF2P7ttKx++OMBsKOCXizub8o/iV8Ptc+DvjTUfDfiTSr/AEDXtHdY5LG/tdsm4qMoSQAzD7wIGMMMFvvt/WuY1k5ZVYnkkjqa+Vf+Cnf/AATL8J/8FAvh2Y3jtdH8daUn2nRdbRArQPGSfLmI5kjfdja2QDk1+o8K8fYnCTjgszTqU9oy191X69z0a2Gjyc1Pc/m2ZGtXZF3hP4STyQeuf1H4V6B+y5+0p4r/AGS/jLoXjTwffmzvtIuYzPBvKpdWwJLxMAfmUgn5TxkmsP4v/CHxL8BfiLqnhHxfp02l+ItDneC8hfJBYsWDKx+8pVlIP4dq5nuv+yQw9iOhr9zjRw+YU1CpJTjKOj6M48PUlRlee5/U5+xN+1j4d/bN/Z00fx14cnTydUi/0izVsS6bOD88bL2HQ/Rq9iSTzJJPmWTa23cF2g8Cv58/+CDX7dF5+zV+1Hb+D9Wv5IfB/wAQJRZSbzujtb5sCKXk4CnAD+oC56Cv6B9OctbfMrKVJBDeo7j/AGT1HsRX8x8TZPUy3Gypr4G3b0PajWVaOhZi+Z+ea+bv+CxA2/8ABNn4uYH/ADBD/wCjEr6TgHy/jXzX/wAFhjn/AIJs/Fz/ALAh/wDRiV4uCVsZSS/mX5mdaPLGzP5kZv8AXP8AWpdK/wCQvZ/9d4x+BYZqKb/XP9al0r/kL2f/AF8Rf+hCv61r/wACf+D9Dx5fxUf13eC/+RS0z/r1i/8AQBWnWZ4M/wCRR0z/AK9Yv/QBWvCuV6d6/kjE/wAWXqz6WOwQrlenepAMUAYppP738KxGOopz8Gm0AFFFFAELsRej/dH86/Iv/g6v58K/CD/sIXo/Axpmv1zf/j9H+6P5mvyM/wCDq/8A5FX4Qf8AYRvP/RaV9RwD/wAlBhf8b/I55/DI/GeI5jX6V94f8G6H/KSzQ/8AsD6h/wCi1r4Pi/1a/SvvD/g3Q/5SWaH/ANgfUP8A0WtfuXGn/IrxX/Xv9Tw8P/Gif0NWP3Py/ktfI3/Bdz/lGT8Rf+uFv/6V29fXNj9z8v5LXyN/wXc/5Rk/EX/rhb/+ldvX875P/vlH1X6HvVtpH814+8fov/oIrv8A9k8bf2qPho/8S+LtG2t3H+nQjiuAH3j9F/8AQRXf/sof8nSfDX/sbtG/9L4a/rDMv93q/wCH/wBsZ4+H3P6w9M0SzgtAsdnaooZsBYlAHJ9qn/sq1/59rf8A79inWX+o/wCBN/6Eamr+PpXbuz2qcVyor/2Va/8APtb/APfsUHSbU/8ALrb/APfsVYprId2VPzMNoB6D3pF8qM270i1N+o+zxgbRwqDHU1V1GHTdOhkkuVt7eCEb5JJCI1QepPpXH/tC/tN+F/2ddD+2eIdXgtnkXbb26/NPeyDJ8uMDnd068c/Wvz++MX7WXxM/bn8Zt4b8KabqVtpd2dn9kW8jRSyRgnLXUynEajOcKeeleLmOa0sKnClrN9D5LPeJMFlsvZyXtKr2itz239qz/gp34d8DvdaH4FSHUtQUmObVJUxa2TjONpXlm6dOORXjHwe/Y++J37aHiT/hKfGV5dafp10Q0tzeM4e4Qcgwr/AmDx05Br6A/ZJ/4Jl6B8Mktde8T3Fv4j1jgwwrEv2ODHQBD1w275iMmvrPTbZ7T5QIY8fwr93OMcfgBXm4PKa2PXt8a3Hslpc8Wjw7i84lHG5zPkhvGl1S7PufHv7Uf7K3iv4Afsh+IE/Z3XTdL8bxol5LdX8QuLjUURWDQpIfmUvncMHgw4/jr+eDx94v17xr4wu9Q8Salq2ra4szLc3epyvJdyTD5ZHZnJYFmDEKT8qlV6KBX9bt1b/aJ5NyKxWJhnOOWKkY/wBoFAc/Sv52/wDgvd+zdZ/s+/8ABQjWLrT4TDpfxE04+I4FhG2OG4keSOUYHAZpIWkbuWkZjySa/dvC/FQpy/sicUnPVNJX+8+unh6FCgo4aKjG2yVvyPiuGGOCGT93+5+WMLGMNuZiRj23AE/QV/RB/wAEGf2nZf2h/wBhHR9P1K+a8174f3A0a88yUyF4kRDGVz/CEYIOw8vFfzxrKy+WyttYKp+U42naM/596/Vr/g1v8eta+O/it4Tby/stxpdrqUSgfPHsmaJ9voCZoycdSBX3niZk8cRlHtY/YdrnPgJNysz9nEJNiFJZv9YCWOc/NkV+BH/By4c/8FIU/wCxK0//ANKr2v35AZbVg3Z5gPpvOK/AX/g5b/5SQr/2Jen/APpVe1+beGbvm6t/LP8AI9LH/wAM+Arf/j4b6n/0EV+1f/Brf/yb18TP+w1Z/wDos1+Klv8A8fDfU/8AoIr9q/8Ag1v/AOTeviZ/2GrP/wBFmv0/xM/5E8vWn+R5+E2R+pEP/HrD/wBcxTs8U2H/AI9Yf+uYp1fzkuvq/wAz147ABiop/v8A4VLUU/3/AMKYxlFOA/dfjUcRyD9aDGW4yf7/AOFMp8/3/wAKQD91+NBJBP8Af/CmUrHJpKDGW4Ud6KKVkScv8YPhzp/xV+H+q6DqccUlrq0BtiWjDFAQxLc9CoB2nszDHNfkH438I3nw/wDGWqaDqAA1DR7p7S4x91mQ4DD2K7SPY1+z00byTMEEf+pcsXGeAVP8wD+Ar81/+CpXw8h8BftETanZw7LfxFZRXcWFwJZlYROPoEMX6V8Rxxg+bBe27M/LfFLLYrBQzWn8UHynzrQp2PuXhvUdaGGHbH3Vd4wfXYxQ/wDjymivzOrU53fofi8oyi7S3PUv2MfiSvwv/aM8OXsrstneXkdtdtnAVWJAz9Tx+FfqkxysnJ/1jHH90EkgfkRX4v2t82m3MVxG22S1cXA5wHKEFc/Q5I9M1+wHwy8SN4x+HWh6szq76lYwzvt/vbADn34r9J4HxjeFnTXRn7D4c5nzYOrSk78rsbUR+U/WklGEp4GKjnPzfhX31TSR+oXb1KZ60VPtHoPyoqDmnuWalg+5+NRVLB9z8aDp1HlQT0rA+JXw60f4teBdU8M65YQ6po+r25s7y1c7Q6SkAIB03OV4bqhjzxmt+jH8mX8GxuH44GfXFbUJQvzydpR2XcUpxadKSvzaH4U/tM/s2fEL/gjD8cr7XtBdvEnwr1+5jIuPn+ylUmkKw3mOQ8LFtknUsSc81d+LnwM8C/8ABRDwF/wlHw/1Ox0/xZGwmnDy7hDKPnMd+h+4dz7kmT5mLAE/LX7U/E74U+H/AI1eDb7wz4o0ey1vSdZia3kgvEAiHy4JWTBZXxjBHoK/HX9rz/gkZ8UP2BvGVx48+Bd1q2v+C13PPp0KGW/0uJWZvJmB/wBdAOofljuYdAK7sRyZxUWMqN0cyiuWE0rwnTX2Z9D47OMhq0J+2o6rr5enY8h+Fn7eXjz9lTxR/wAIb8WtL1TULWLEa3U6kagkQ+UOrNlZ0+U7VQiTA5ONtfZnwj+OXhf466X/AGl4R1iPVExl7dQiXNsuBy0EnzK3P3Wy3fOCK+X/AAL+218N/wBrPwYnhj4vaLY6NeqAJluo3h04SE7Q32gATWchxgH/AFZwMjrXK/Fb/gljr3gnWl8R/CnxM11bxAT2tpPqC2dxaA8qFvI8xSDoQcRA5+/nIHwPFHDuT5lX+pZg54HFP7UoXw9X/DUStFvomzgw8q9J3wvvQe7ep96JIso3L5ZVujKxLP7sp+43+yOOh706vzx0j9v/AON37LV9DpPxM8LzaxC58i2n1WFtPllx/FDdAtFcntndOTjGOBXvHw0/4KtfC/xe5i1qTVvCN5J8rtq2nyLbq2B0liD/APpPGP1NfmubeEOb4Gi6+HwrrUOkotVXBf3ktV366HrU8TQqS5Uz7Y+Av7R998Br68UQW95pd6uZ4GYiQnpkfkK0/HHxH179rrx3o2m2tsthHGkv2ZUHmbQAMPIx+bPOMegFeG+CPH+i/Eq0ju/DGvWPiBduW/s2WK4bb14wwweejKr+qgEZ9D+BvxNX4OfEWDXvIa6to8xT+VCUlTPVHDclu/HHIrwcvx2IXLluOnKVFaLmTjG3zs/vPXo4yo0sNT1p/a8jrPjH+yR4k+EXhZ9buLzT9Qs7fb9oW1B/d5A7Hp6/jXlaIsbMFZmXOVLHJwQK+hv2if2xdI+IXw7vdD8O2d40uoRlbqa4Xb5R44A9sgg+9a/hj9iHw/deBLW6vNRv5ry8s1nDpKRg7UAwM/3nyT34rqzLhWnicYoZNZqK95J3S9H1NZZbRq4lRwjuoo/LD/gstarL+yZDJtX9zrVsxOP9iUf1P5n1r9UP+CON22o/8Ew/gjLIzSFvDcagsc4VZJFUfQAAAdgK/Lf/AILoWUvgP9nW90S4uIriTT/EkNncvEu3zViE24J/tHanI5wJPev1U/4JHaB/wjH/AATZ+C1nhl2+GYJsHsZS0px/s5c7R027a/duA8O6PCFGjLdVKn6G2TxlHmjPfU+kpRgj6U3aMdOxH59adL1H0qMn97+FelGTse9T+E/OX/g4K/4J4w/H34ITfFrw1pufHHgW3D3rQQB5NT0pdxuVZQMyTRApLGTkgRyKMbzn8JWRlRTjCNkJ64DFSD7hgwz3xnvX9eGqWEeoAwsGLSxlQo6N3wfqA34V/MH/AMFHf2ZG/ZC/bO8b+B449ukW9819oz7cK9ncEzJtHQKjO8YA4AjAHAr9o8NM9rTg8oltun2XkceOw93Fnh9hqV3pOoW91YsyXVsWaN8kbG4IwexO3qK/p2/4Ja/tLWv7Wv7EfgzxlHK0mpS2q2ep7mLN9qhRUbJPJO0Iea/mMcLbDbIJNkmCmzsw6Gv15/4NhvjfdXnhf4kfDW7uJI10uW21rT4o5Cqqk/8Ao0pA6AhhGxx3wa9DxOyxYrKvbw+wzPC1uSrydj9goGZk+ZdvNfNf/BYT/lGv8X/+wE3/AKMSvpKybfBnczcleTnpx+uM/jXzb/wWF/5RsfFz/sCN/wCjEr8Ly2V8TRf95HoYiV1c/mRm+/Uulf8AIXs/+viL/wBCFRTf65vrUulf8hez/wCviL/0IV/XNf8AgT/wfoeLL+Kj+u7wZ/yKOmf9esX/AKAK2IPufjWL4MP/ABS+l/8AXpF/6CK3FGBX8kYn+LL1Z9LHYWjHNNJ/e/hUj8GsRjc5ooooAKKKKAIH/wCP0f7o/ma/In/g60bHhb4Q/wDX7fH/AMdh/wAT+dfrs/8Ax+j/AHR/M1+Rn/B1eM+FfhB/2EL0f+Q0/wAB+VfUcA/8lBhf8b/I55/DI/GphjP++4/8fYV92/8ABuh/yks0P/sD6h/6LWvg+M5jX8/6194f8G6H/KSzQ/8AsD6h/wCi1r9y40/5FeK/69/qeHh/40T+hmyP8h/IV8kf8F3+P+CZXxF/697f/wBK7evrey6/gP5Cvkj/AILv/wDKMv4i/wDXvb/+lcFfzvk/++UfWP6HvVfhkfzXD7x+i/8AoIrv/wBlD/k6T4a/9jdo3/pfDXAD7x+i/wDoIr0T9kxc/tRfDLjr4x0cf+T0Nf1hmX+71v8AD/7Yzx8Puf1hwMRF1/ib/wBCNP3t6mktxl8f73/oRqN2aN2ZmGzoP9k+p9q/jeUXCXOz1lsQ6hdNBMu7zGVhwVcqEPqfavln9sf/AIKO6f8AA6Q6HoNxb6pr0kZE0rN/otj94A5Xkvkfd9MetZ/7XH7VXiHxf40X4c/Ce3uNX16+jK6lfwllj09csMCQfdPGcDsfeq/7LX/BNHSfAN3a+JPH0i+IvElzJ57wMge3jk45dWyGbj7x56eleLj8diMQ/YYNabSfY+ZzLGY3FVHgsvhy20lJ/oeBfBT9k/4lftua7/wlXjbULyw0m9G03ly7pJcDcT5UCZzHHhshhjJZvSv0H+An7PfhX4E+D7fR/D+kWdmsSjzpCivNK/q7kZY8Dk12OlWi2Vu0axx26qdoRPu4wMY9varaKFHy+mOKrKsow+DvNvmlLvr+Z1ZNw3h8D+8m/aVXu3rr5BZ2cKNKyxx7pG+Ztoy31pz20cJAWNF47Cn2ihYzj1on+/8AhXvJ3R9DyuWtRalSezjM0bbVLZ+VSOAfUe/vX4Y/8HQurWs/7Wvw/wBPtpPLkg8LyPchDjyt13KVf6nZIM+hNfth8UPFun+APDV3rmrX8el6bp1vI1xdyS7I4Fxu3HtnKKoPX5yB1r+Zf/gpn+1n/wANrftleMPHEMjtos8o07SImJ2w2UGUQAdAHbzJcDgmZj1JNfoHhvl9erm3t4/ZRx46sowseEXAX7RI4UL50jy4A6BmJUfgpX8K/S//AINedPY/tfePbwqPKj8IFGyOub61OP61+aCK0gdmK7I1BOfvHAwB9MACv19/4Ne/hTJFonxR8dTW8kS3BttDtHbhGBKyzY91zEfy9BX6Zx5jHDIpxe8meZgJXnc/YAQrGBHncGkYMT1OdxwPfpX89v8AwcX6jcal/wAFKtQW58vbb+GtPhhA6iPzJ2w3vuZj+Nf0IRneeV+aNm5PcjADfUr39zX88v8AwcNj/jZfrB7to1pk+uHmAr8y8LV/wrfJnpY/4D4hAxfSfVv/AEEV+1H/AAa3/wDJvXxM/wCw1Z/+izX4rpzcf99fyr9qP+DW/wD5N6+Jn/Yas/8A0Wa/S/Ej/kTS/wAVM8/CbI/UiH/j1h/65inU2H/j1h/65inV/Oi6+r/M9eOwUyYfLUoH7r8abEN0DZ5+bvTGV4jmBv8AepsXQ/WpMYib61HF0P1oMZbiTD5aiiOYG/3qtbcxdO9Ven50EkJH7s/Wo4jkH61cCjyTwOvpVUjBoMZbjgP3X41HEcg/WpB/qfxqOLofrQSMnGW/4CR+B618df8ABX/wct/8M/CuuKq+dp+oS2YfHzRxvbSykg9vmt4xx619iz/f/Cvnj/gp5on9r/smanOsatNpt5bTRgjO7dcQxv8A+OMw+jsOhNebnmH+s4CaX2T5njTD/Wcgxi/lin8+5+arz+e27YsfmE3BQDARpiZmUD2aRh+FNo/5ayFWLxsxKMf4h/8AryPwor8JUbaH81yut+y/ISRFuEWM9VbcP9vI5U+3HSv1F/YP1r+3v2TvCc7EtMsDRyE8nIdgB+AwK/LpoBMOWKHHyEHBB3L0/Ov0n/4JtXrXH7LunxMu37Ne3MQ9wH4r7XgrEqlWlB9T9F8OMQqWPdN/aR7xEcg/WmT/AH/wqUDFRT/f/Cv1P1P2qF0rDKKkhXK9O9FBhPckqWD7n41FUsH3PxoOnUfRRRRZbm8UrXJYP9W47ScMP7wHTNSBJrm4VsjZH8zE/e9OtRwfc/GpoDtc4/iGD71SlJaplPVWZ8m/tqf8Eifg5+2fq8l9eaTN4W8VS4kGu6BFHHdFiW+aZGXyiCePMlDMwG0EFRX50fGD/gmR+05/wTwm1jxB8Ptebx54L0qQ3V/Fp8yr9lRdr7p7KfLE7I8sITvKt12lQP3OngRmXKKdo4yOlcL+0pDGn7Ofj8bFCxeGNS2DH3P9DuMY9Oa9nDZzi54f+y8TarQnL4Wk7ffszz6+W0a6tD3bb20Pwh8B/wDBXG21nSX0z4keCoZ47rK3d7p8avDdMoCNi0uirqPl5BmznPy9zrwfCv8AZT/afnB8N6hYeENbu0837LaXJ06YISekNwvkfe3f6ssP9o9B8RSqsUzhY2VgzMHQYKljlufckk+pJqm2jrJAy/Z7i8SGVJ/KVJJMjDh/lztx909M8fSvv/8AiEuFjXlickxOIwslG8nGSjC9uqluvQ8GpltWErq0o9Et0fY3jL/gkD4r0Kf+1fAfji3uliXzoFvYJ7GaMEkD99EZdx4+8sQX364w08d/tYfsteTDqWn6p4k0yNSjmSNNcimReQfNjLXEWOvzmAEd+tesaJ/wRS/ag+Gvw40PxR8IfHVj4gtNasba/TSdL17+z7yMSxJJiWK7ZYZMZHIkyem3jJ5Hxb+2Z+09+xzHNZ/GD4b6s2mtKtsbzVtGmsbZmTB4ulHkyEdcoJvpX55isszeVN0qk6GOhqneyn81umTCjVpayoyUX6l34Vf8FpdLvJFh8eeGb7Sppvkmv9KuFkVGHG5rWTDAcYKI8/TOMmv0b+BX/BTNviZ8Lof+EV1PQPEccUJtor6GCcXVuuEJWSJyGQ/dJASMcD5eMn85B+2N+zj+15uX4heD4dB1i8UJ/aN9YXEkd0cYIiurby5FK9QzJGFzllKkZ4D4pfsi+Jv2EJIvjD8E/FUmveGIE/tF4fPivmeyhz5xnlhKx3FoFlIaVdrA4xtMLzR/n1TIMt+tTwmBVTLsVXi4q8XOjUlH4UpLSEpaqzNsFjalGUlTVk9u56P/AMFzPGN1e+AfBtndSLNearrc+rzZjZfNEcTxsyhiTktdk59SfU1+5n7F3g4fD39kH4W6GVZZNH8JaXZSb/vAx2cSc/gAPpiv54P2ufGp/b2/am/Z98M+HYGVPEdnpyxwLKZPs9xqc6rcRngErC0IRWYBmVFdgrMQP6YNIhjs9MWGNVRbf9xhBtXCfIMD0wor6nLcHWyzh3BZdiU1UlOUnzb363t3sz3smoykm5blzOadEuX6U0dKdD9+nzX1PajGysSXLtBKrqqN5Y3dPmHUZH4Ej8TX4p/8HQ/wmsvD3xh+Ffjq0hYHUdKvrK9wuA32V0mgj/4EJrgY9Fr9r5k+fOOduCfUV+XX/B0hocdz+zD8Nb/ZbhrLxbsZmyG2NY3Xy8fw5HSvrOBMW6Oe4WP80mvwManwyPxJud1vL5ayOywkxoS2WwpK5J9TjOfevvD/AINy/Hsnhv8A4KM2ml+Yyx+JtDvLeUFjiURhJAPchgp+oB7V8FznMzH5WZsMxUltxIBySe9fVH/BEzWJ9H/4Kc/DFow22aeeEsOsYZAGx6ZGAfXFfuHEuH5sqxl/5L/iefhe5/SxYxCOBdv+rYKUB6qNoHP4gn8a+bf+Cw3/ACjY+Ln/AGBD/wCjEr6UgPDD+6xGfWvmv/gsN/yjY+Ln/YEP/oxK/mvBR5cZSX95foelV+E/mRm/1z/WptLuls7+KVgoWHLMxXdgcZIHquMg1DN/rn+tNjYwy+YvyyYK7hwcHqM1/XvIm1OPwOHLL5o8uFRU6nMz+hrw5/wcEfsz6Vo8NvN4t1ZXjXPy6HdXK4b5gA0SMoAzgDOQB0xir3/EQ5+zL/0OGtf+EzqH/wAar+dfPyKv8MahVHZQOgHtRX5s/CvKU3+9f3nW80nf3Vof0Uf8RDf7Mmf+Rw1r/wAJnUP/AI1Q3/Bwx+zHIefG2tR+x8PXqfo0JNfzr0odl6E0f8Qryn/n4/vF/alT+U/om/4iFf2Y/wDoetZ/8EV3/wDGKP8AiIV/Zj/6HrWf/BFd/wDxiv52vMb+8350eY395vzo/wCIV5T/AM/H94f2pV7H9Ev/ABEK/sx/9D1rP/giu/8A4xR/xEK/sx/9D1rP/giu/wD4xX87XmN/eb86PMb+8350f8Qryn/n4/vD+1KvY/omT/g4N/ZlkbcvjbVm7ZOh3YP/AKJr8+/+C8P/AAUS+Fv7dWh/Du1+HOtXWtXfhu6urq8jns5LYeWyKBjzFU9R6Y96/NtvnPzc/Wj+Er/CQQR6g9a6ss8O8Bgcxp4jCzbcVffqZVsfVqR5Uhzp5ZAyu3AKgDlQecE9z7192f8ABuh/yks0P/sD6h/6LWvhEnP4DA9q+7v+DdD/AJSWaH/2B9Q/9FrXqcZScsqxLf8Az7X5mGFv7WPNuf0N2I+T8v5CvkT/AILvH/jWJ8Sva3tse3+lwV9d2P8Aq/y/kK+RP+C73/KMP4lf9e9t/wClcFfzvk/++UfWP6H0VT4ZH82Cf6qP3Rc+/Ars/wBn7xdZ/D/45eBdf1KRodJ0DxLp2qX8q200zCC3uopXACRsPuqe+fauMj/1Mf8AuL/IUnkoZfM2r5m3buxzj0z6V/XGIoe1qewh8Mo+95aHz1Kp7OfMz+iS0/4ODP2ZI1x/wm+tMQEznRLvKnYuR/qeucnPqao+Mv8Agvb+zb4g8O3Fnb+PfEFnJqKm3R49Duxv/vjeIco208N6mv57HdpG3MSzepoV2TdtYruGDg9a/KpeFOUzd41Hb1Ot46q3eK0P35+FX/BaX9jz4JaM1h4f16/h3EtPdN4bvp7y6c9TPN5O6R/diTgL2xXUt/wcF/svSdfGWrR8YI/4R28TI+jQ1/O9JM0u3czNtG0ZOcD0pA7L0Jq6fhRlEFpUaBZlUjpyn9Ea/wDBwd+y+igL421YAdANAu+P/IFOH/Bwt+zGgwPGWsye48OXzfqsIFfzt+Y395vzppYt1qv+IU5R/wA/GCzKoton9FCf8HC/7MoHy+LNaYe3hvUB/wC0qy/GP/Bxh+zj4e0hry11LxZrsmCv2Wy0SeGU+nzXPkxjr1359q/nqKhuoH5UoG3px3qv+IVZVD3nUf3h/alXsfb3/BTT/gtN40/b0sLnwrodrceDfh6u1p7Fr7dcaxGrlh9sljC+TEMKVVC5ZlbLEYA+I5XjmKyReY0Uigo7Ls8xQNoIX+FQBtA9Fz3ppUMeRnnd+PrTivmK0k80cMO5ULzkrHubo5dfmwmMsOhDKK+yyfKMLgaH1DL1yt6ym/8AM551JVHzS6kmnaZNrV7HZ2lrdX11dstsltBnzJ2fO3Zjv8pHHd1r+nX/AIJgfsjD9jX9i7wj4NvEifWZLddT1ltg+a9njQzA+u0gRjPRY1HQAV+aH/BBL/glpdeP/Eel/Hrx9ps1l4YsX83wxZ3sPlTajIHUNeGLHyxBo1ZMjIK7h1Br9rrOfzomZgiuzMWCElevBGfUYP1Jr8Z8SuIFiqyweDlzxi7Sa2O7CU+SDmOu22WUzLwygcjtyK/nl/4OGDn/AIKYa1/2B7T/ANClr+hi5YNp02Pb+Yr+ef8A4OF/+UmOtf8AYItP/Qpa5vDVRWcJQ2sRipc1FM+I4/8AX/8AfX8q/aj/AINb/wDk3r4mf9hqz/8ARZr8V4/9f/31/Kv2o/4Nb/8Ak3r4mf8AYas//RZr9N8TP+RPP/FTOTCbI/UqAf6BD/uCmxHIP1p8H/IPh/3BTIuh+tfzkuvq/wAz147Eg/1P402H/UN/vU4f6n8ajiPyn60xkRPNIBinTDDfhTaDGW44f6n8aqnrVjPFQzDDfhQSA/1P41VPWrQ/1P41VPWgxluOH+p/Go4uh+tSD/U/jUcXQ/WgkZP9/wDCvEf+Ch5x+yN4obuqwFT/AHT9qg6V7dP9/wDCvA/+Ckmqtpf7J+vbdjG4ltY9rdx9rgrz84k1gZ2PH4g/5FdZd0z8y50WJwiqFVVGFAwBkZ/mSfxplKd2BuYM3OcduTSV+Dn8toZOhkkh/wBklj/30lfpT/wTcsJLL9lDT3kZma41C7kBJ5x5mP6V+bEjeTDJIekKmY/7qckfjkfkK/Un9hzRW0D9lbwfbt957Uzt/tGR2fJ/BhX3HBeF9tWcl0P0Lw2w7rZliJfy01+Z6shygpk/3/wqXpUU/wB/8K/UpO7P3K/6DoPufjRRB9z8aKk5Z7j6lg+5+NRVLB9z8aDp1H0UUUG8diWD7n41LD9+ooPufjUsP36CixL1H0rhf2lhn9nX4hf9ixqf/pFPXdS9R9K4X9pb/k3X4hf9ixqf/pFPXRT0q0mu4R02P5W55WSeQKzAbugNQXcS3MJ8xVk2Biu4Z2kqc4+uKmuf+PiT60KuYJOOx/8AQTX9a/HRoKeur316HPtK6P6oP2QXZ/2UPhvuJO7wxp6nJ6j7OnFd7faHZ6tp0tvcWNrdJIoRY5UVo3HdWB4KkHoeDmuD/ZFGP2U/hr/2LGn/APpOlekRxq6/Mqt9RX8m4yKpYuq6envPbTqd0ZOUVzHxv+15/wAERP2bv2pV1ORvBNv4H8RXCL/xOfCsaafNann5niwLRoyckmVGZzuAIwK/Jn9rD9h/45f8EZvFNxqWmX0Pir4S6tMqX96lpKummJxJEg1CCVyLZ8FgsiPHuLkAuPkH9Fk0aq6/KvyjA46CuH+P3wQ8O/tAfCDXPB/ijT47zw5rlq1peo6giOJ1dHkj4O2ZN4dXA3KQCCCK78rz6rhqsaFVc1Ju7vqk+68/M4sTl8cR71Ldbn4C/wDBuZ8A1+N3/BS7TPETafGuleAbO619o5WaTyZy3kW0TblX7oleVMohHlRkD5Q5/o6sdhtx5fl+WxMi7egD/OP/AEKvzr/4Nzv2C9Q/ZT/Z68ZeJPEMcVr4o8XeIp7Py0LD7NY2Ez2+fm5BklWdxjjY6V+i1ugjQ7RtXcSq/wB1c/KPwGPwxVcTYyhjMY44Z3jB6M68BGWGpNz3ZJTofv02nQ/frxZKzsdFL4ESXbESL/u1+Wn/AAdI+M/7P/Zp+Hmix3CrcXniOS+CEZykVlcxn8N06H6qPSv1F1ZvJKtubd8r7f7yqSWA/MV+H/8Awc4/GJNd/aI8B+C7W4W4/wCEV0a51G+Tdu2m4u4gqkf3wkLD12vjoa+s4HwrrZ1Smvso58QfmXcszOrOyszDPAxj0H5V9Wf8EQNCuPEX/BTr4axQ7vLtzdzzY7KI1wfw5r5Qfd5nViqpGg3H5htjVGz7llYn3NffP/BuF4Bm8Vf8FB31hUYW/hfQLm6lf+H94yIAfyP51+7cVVvZ5Ti5P/n2vzOWhuf0D7gP9W3y9jnrXzX/AMFgRI//AATV+L+0bv8AiRN+fmJX0fbKYoSp2jazYx6FiR/Osvxx4E0n4peD9Q8P+INLtda0PVYfJurO7jWS3uFzna6sCCOAcEEV/LNOsoThiv5Wn+R63NzrkP5HFt2cZYYOfzpfsh96/p+g/wCCWv7Ooj2/8Kb+H8hXhiNJSTn6hf0p3/DrX9nX/oi/gD/wSr/8TX7ZHxWwSjyypPz8/wATz6mWtybP5f8A7Ifej7Ifev6gP+HWv7O3/RF/AH/glX/4mj/h1r+zt/0RfwB/4JV/+Jqf+IqZf/z5f9fM0jg2lY/l/wDsh96Psh96/qA/4da/s7f9EX8Af+CVf/iaP+HWv7O3/RF/AH/glX/4mj/iKmX/APPl/wBfMr6qfy//AGQ+9H2Q+9f1Af8ADrX9nb/oi/gD/wAEq/8AxNH/AA61/Z2/6Iv4A/8ABKv/AMTR/wARUy//AJ8v+vmH1U/l/wDsh96Psh96/qA/4da/s6/9EX+H/wD4JV/+Jo/4da/s6/8ARF/h/wD+CVf/AImj/iKmX/8APl/18yf7Pb1P5f8A7Ifeo5Y/KbFf1CH/AIJbfs6j/mjXw9X66TEv/oSV+Zf/AAcbfsrfDv8AZq8N/C2bwH4L8M+Fm1W/u4roaZYxQtc4jUjeyqCwGeAeAee9elk/iPhMbilhqdF66GdXBukuY/K2vu7/AIN0P+Ulmh/9gfUP/Ra18JEFVUN97HNfdv8Awbof8pLND/7A+of+i1r6PjaKjlmKSVv3a0OWi71os/obsf8AV/l/IV8if8F3v+UYfxK/697b/wBK4K+u7H/V/l/IV8if8F3v+UYfxK/697b/ANK4K/nTJ/8AfKPrH9D6Cp8Mj+bCP/Ux/wC4v8hSmJn6bvwpI/8AUx/7i/yFdx+zLoVr4i/aP+H1hqNtb32m6p4r0iyuraaKSRZInu1DqwU7SrKcEEcjrxX9WYyrCjTqYlwb5V+iPm5RvUUP5jjIbViv8XWnfZD71/T5Z/8ABLv9neaHn4MeADtwM/2Gi7uBzwtSf8Otf2df+iL/AA//APBKv/xNflcvFTAKTTov8D0/7NlD3bn8v/2Q+9H2Q+9f1Af8Otf2df8Aoi/gD/wSr/8AE0f8Otf2dv8Aoi/gD/wSr/8AE1P/ABFTL/8Any/6+Y/qjWh/L/8AZD70fZD71/UB/wAOtf2dv+iL+AP/AASr/wDE0f8ADrX9nb/oi/gD/wAEq/8AxNH/ABFTL/8Any/6+YfVT+X/AOyH3poHky7WZSu3O1njjVP9osQWx7dOK/qC/wCHW37Ov/RF/h//AOCVf/iaksv+CZX7O9hefu/g78OkfAZo5NGhYOPdHQgij/iK2D2VF2D6qz+Zb4XfC/xT8aPEg0fwf4d1TxTrMhHl22k2r3EpB43ElTF5fXlvL5B/edAP1T/4Jwf8G7d1Jrum+MPjotuY1G+LwraScSjCt/pfJQgnIMQaRPkBzkkD9cvAHws8N/DXRo7Hw/4f0PQ7CF90Fvp+nxWsUXAHyrGoA6dcVvyW8cysrorK/wB4EZ3fWvlc78RcZjoulRXJHZW7GlHBU4y55MoeHdEs9Gs/s9rbw28UIEKRRxhVhRURRGMD7oVVHpwB2rQ8tf7q+nSlRFiQKo2qvAA7UtfApvc7ny/Z2KuprtspsDHA/mK/nj/4OF/+UmOtf9gi0/8AQpa/ogupI90aspb5xuHYghsZ/EV/Or/wcDammof8FNvEka5zZ6ZZwNnudrN/7NX6B4a/8jheh52O0hofFsf+v/76/lX7Uf8ABrf/AMm9fEz/ALDVn/6LNfivH/r/APvr+VftR/wa3/8AJvXxM/7DVn/6LNfpniZ/yKJ/4qZwYTZH6lwf8g+H/cFMi6H60+D/AJB8P+4KZF0P1r+cl19X+Z68diQf6n8aji6H61IP9T+NRxdD9aYxk/3/AMKZT5/v/hTKDGW4VFP9/wDCpain+/8AhQSIP9T+NVT1q0P9T+NVT1oMZbjh/qfxqOLofrUg/wBT+NRxdD9aCRk/3/wr5V/4KzeIY9L/AGfbKy3bZdU1SOEAHqFincf+PKjfVFPUCvq2R13LHgbpDgGvhD/gr/4t83X/AAnoKMsi28FzqFwp58tlKrC3sWJkXPpkV43EE/Z4OSf2j5TjbEfVskxbfWKt958brwWG0LhiOB1560tK67ZH/wBZy7Mdx6EsSR9ATj8KSvxDl5dGfzhJ318l+QMqzQSR7WeSZDFgdMMQD+dfr18G/Do8KfCbw3p6qVNtp0CsPQ7Af6ivyp+DvhiXxl8VvD2kxru/tTUraJuOiq5Lfnnn6V+vgt1sx5MZ3RwARKfZQB/Sv0zgOj7Lmxz2Xun6x4ZYZxoVq3d/gFRT/f8AwqWop/v/AIV95ycvun61LcdB9z8aKIPufjRQcs9x9Swfc/Goqlg+5+NB06j6KKKDeOxLB9z8aXcRL+FJB9z8aU/678KCi0DkVw/7S3/JuvxC/wCxY1P/ANIp67gdK4f9pb/k3X4hf9ixqf8A6RT10x/iUfUD+Vq5/wCPiT61G7ERP/un/wBBNSXP/HxJ9aik/wBU/wDun/0E1/WsP4VD1f5GEr3P6pP2QDn9lH4a/wDYs6f/AOk6V6XB9z8a80/Y/wD+TUfhr/2LOn/+k6V6XB9z8a/k3Mf96qf4n+Z2U/hQ8rntSBFEivtG6Mkq2OVz1xS0Vxlx02JLaNUg2KqheRtA4weoqTuT3PX3pkH3PxpSf3v4UJJbGy1Wo6nQ/folGCPpUb8jgOZFI2AHaGJ4wTQUZnxE8R2Xg7SptY1GaO3sNJga5uppH2LBEOrBu3zBM/7Iav5cv24P2jrj9rP9rTx58QJplkg17U5PsUQXb9ltUxHFGf8AgKBz6lya/VL/AIOH/wDgoxaeG/Ba/A/wfqUc+u68inxNPBOcWdq7NEtoGB+WSaXYC3BSNJOznP4rhQV81VKrMSRk85UlGBHbDIR/tY3fxV+2eGOQzpwlmNdfvX/DXeHc8vMMSm1TRIZmWG5kVVafynfc43bizIpOO5BfOfev2b/4Nh/gQtl8NviF8QpLWZ4devYtJs7kjyw0Nps85QO6s5O7s2Oelfjb4Z0W78R+JLHT7K3mvrrUZVtLe1gz500jkYC45xgN/wACCHqBX9R/7BH7NVv+yP8Asm+DfAK+XLdaLY/6fMqALPcynzpmHqC7kZ74rs8Tc0p0cH/Z9F61fe+X+Vy8DH37Hs0MWGk+63zk9Ox5H86kVFU52jPrioQdtea/td/tAr+y3+zr4s8fyafNqkfhey+1vbrN5XmjeowGPy569u9fgVCnVqONKK1fQ9OUeSXOepUV+RNr/wAHV2hzW4lX4Q6u6zM7L/xUFvJtG9hj5VGOnQ81J/xFV6L/ANEd1f8A8HcX+FfTrgrOGrqg2u4e3pPVs/XKivyN/wCIqvRf+iO6v/4O4v8ACnx/8HVmh7fm+Dut/wDAdZhP9KP9Sc5/6B2HtaPc/XOFcr070/YPQflXwZ/wTc/4LUWH/BRz466p4NsfBOpeETpOjNqrXNxfLOJP38UAUBeM5mU8+1fdOlXP2m2WTezrJgqSMHGAP5gmvBzDCVcDU9jio8r6rsaxs1eOxa2r6D8qNg9B+VKBiisVGNtBibB6D8qNg9B+VLRT5UA0na3HHFfkT/wdWH/infgye/8AaV9z/wBskr9dn+9+FfkT/wAHVn/IufBn/sJX3/opK+p4B/5KDCr+8zHEa0mfjLbu0ltGzEszDkk8nk194f8ABuh/yks0P/sD6h/6LWvg20/484v93+pr7y/4N0P+Ulmh/wDYH1D/ANFrX7nxo28sxTf/AD7X5nz+F/iRP6G7H/V/l/IV8if8F3v+UYfxK/697b/0rgr67sf9X+X8hXyJ/wAF3v8AlGH8Sv8Ar3tv/SuCv52yf/fKPrH9D6Sp8Mj+bCP/AFMf+4v8hXof7KI/4yc+GX/Y5aN/6XQ/4n8688j/ANTH/uL/ACFei/smc/tQ/DH/ALHHR/8A0uhr+ssyk/q1ZdOX/wBsZ4dH4rn9ZFpEq2/CqPmPQe9LEoIPHektT+6/4E38zUgGK/jtpXPdjJtCbB6D8qNg9B+VLRS5UMTYPQflShF2fdH5UUZo5UAyJQQeO9MmUB+g5GDx1qYDFRT/AH/wpgRqoQYUAD0FLRRQAUUUUAQXh2tH/vL/AOhr/ifzr+cb/gvQc/8ABT7xoe5stPJ9ybZCa/o7ux+4kPdVyD6cE/0H5V/OP/wXwG3/AIKgeNMf8+dj/wCiFr9I8L/+Rt8jzcWfHUf+v/76/lX7Uf8ABrf/AMm9fEz/ALDVn/6LNfivH/r/APvr+VftT/wa2c/s/fEz/sM2f/os1+ieJX/Inn/ih+px4fc/UqD/AJB8P+4KZF0P1ohP+jR/7gpwGK/nJdfV/merHYcP9T+NNhH7lv8Aepw/1P402H/UN/vUxkDHJpKcR+7P1qOI5B+tBjLckA/dfjVZjk1ZH+p/Gq5H7s/WgkB/qfxqqetWIjmBv96q560GMtxw/wBT+NRxdD9akH+p/Go4uh+tBJX1CNmdCCytvQqwOMbSZD+Yj2n2cjvX5df8FAvGzeM/2ofEEfnLcQaSsWnI4O7dtHmup/3JpJFx22+1fpj8SvE0PhPwTqmpXEyW8Om2skryOcKgKtg/Xcir/wADPrX44eIPEVx4x8Q6hrN2GW51i6lvZVJ+68jlnA/4EW/HNfC8dYv91Ckj8s8Usdy0aeH/AJiqzs5yxLHk8n15NJRTS21/m/1YUtx1OK/MnofjEt/Zdj6B/wCCa3gJvGf7TFndSRq9rosJumLDIDHIB+vFfpCqgZK/dYlh+Zr5N/4JLfD9dP8Ah7rniyaJo/7Wv7eGAuPm8qNWZwD/AHW3DI6HaK+smwp2rwqgEAdgwDD/ANCr9i4Xw/scoUn9p3P6A4HwX1TJo1X9vUKin+/+FS1FP9/8K+nkrOx9pU+IdB9z8aKIPufjRUnHPcfUsH3PxqKpYPufjQdOo+iiigd2Swfc/Gn45pkH3Pxp9BtHYmhOV/GuJ/aW/wCTdfiF/wBixqf/AKRT12sH3Pxriv2lv+TdfiF/2LGp/wDpFPXTH+JR9Sj+Vq5/4+JPrUUn+qf/AHT/AOgmpbn/AI+JPrUU06RxMrqB8rOjPkxtIqnahCfOd2TkZwcCv63w38Cl6v8A9JOWP8Rn9Un7H/8Ayaj8Nf8AsWdP/wDSdK9JhPzV5J+yX4v0u3/Za+HMc2qabDJH4a08MrSCDBNtGSArybiASRn2x2r0JfG+hr97WtJU/wDX7H/8XX8o4zDuVeb9m37z1+Z6MdjoJRgj6U2sM+OtEbpremt9L5f6Bv5/hUkXjbRSv/IY0/r/AM/o/wDiK5vqsv8An0xm3CfmqWUYnX/drhPE/wAefBPgy98vVvFvhuxHlCXZcarFbttyRu3NJHxwf4T0PPYeJfGf/gsp+zv8GbdluPidoWsagoPlWmiTLrN1kZyrR25IxxwWbOSfbOtHA4upUjToUW2yvaUlpJ6n1PM+LuNV+aRl+Uf/AFjxXwf/AMFbP+CxWh/sYeD7jwv4LvrbxF8TtSiKW9pvC2ujhiyG4uHTlcFSEA53Kc8Yr4q/bb/4ONfGvxj0240H4S6TdeAtGuS8MusXk0c+tGPnLwRN+6gJ/wCm2Tj7mDzX5q6hq9xreqTalcXd1fXl5K9xLezvIZrqRuGkYyEyhjjB8wluODt2gfpfDPhviPbfWc0XLbVJ/qZVsVGUeSJc8ceK9S8f+KdU1jXLy41TVtZlefUbq6O6a8kcFWaQc/wkqB3THqaz4V82VmKfaJN8W2MnYGwNpLP1wFVRjoAoqNV2IqqNqr0A6CvZv2G/2MfFH7c3x10nwZ4ftWjtZJhLqWosGEdnbjG/5h0YjOPrX63WxlDA4WVaejgrenkjzKdL2kuU+tP+DeP9gaT44fHdfi9rGnLJ4d+H8jNo5bdIl7f7gW5f7wRTGR2B6c1+8VvbC0jEaqFVOgH3eeePbnH4VxP7Nn7P/h39l74M6F4I8L20Nvo+g24ghZAN05/jkY92LZ59AK7iOJYh8qhR6AV/MPEmdLNsY8RWdkn7noe3Tp+zjyk0K5T8a+a/+Cwg2/8ABNr4tkDldFJB9D5iV9Kwfc/Gvmr/AILDf8o2Pi5/2BD/AOjErgwEm8ZSfXmX5irt8p/MnPPIZm+duCcc/jTfOb+8350Tf65/rTa/sSnJqEUuy/I8uW47zm/vN+dNf94ct831ooq+eXcWp+kX/BsHbxt+3P4qJjQkeDbjkr6XtmR+oB+oFfvRb/dH41+DP/BsF/yfL4r/AOxNuf8A0ss6/ee3+6tfy/4la59Znt4P+CPTpTqanSnV8hHY0jsFFFFMohdv9MH+6P51+RP/AAdaMV8L/CDBPy3t8R7HbCP6n86/XV/+P0f7o/ma/Iz/AIOrxnwr8IP+whej/wAhp/gPyr6jgH/koML/AI3+Rz1PhkfjURtGAMAM4AHb52r7t/4N0P8AlJZof/YH1D/0WtfB8ZzGv5/1r7w/4N0P+Ulmh/8AYH1D/wBFrX7lxp/yK8V/17/U8PD/AMaJ/Q1ZH+Q/kK+R/wDgu+P+NZXxG97e3/8ASuCvriyYKvPt/IV8jf8ABdx9/wDwTJ+Iv/XC3/8ASu3r+d8n/wB8o+q/Q96rtI/mvXr9AuPb5RXoH7KDEftR/DX28XaMf/J+GvPx94/Rf/QRXf8A7KH/ACdJ8Nf+xu0b/wBL4a/rDMv93rf4f/bGePh9z+syyOYP+BN/6EamqGy/1H/Am/8AQjU1fx6e5T+FBRRRQUFFFFABUU/3/wAKWZiG/Coyc0AFFFFADgP3X41HEcg/WnZ4pwXEXTvQYy3K10fkm/3P6NX84/8AwXsOf+CoHjX/AK9bH/0Qtf0azHKTf7n9Gr+cn/gvX/ylA8bf9etj/wCiFr9I8Lv+Rt8jhxB8ex/6/wD76/lX7Uf8Gthx8BPiT/2GrP8A9FmvxVY4P41+zn/BsV4is9A+BvxNW6vLOzMuuWSw/aJkjEp8o7lXcw5H9a+/8SPazylxW3MvzOahufqxjCr/ALo/lRWND4+0GReNX0tUXATN/GxYYHJPmeuR+FP/AOE60H/oNaV/4Gx//F1/P6wsktYNnfqa2eKbIdsfHHPasebx3oIb/kN6X0/5/Y//AI5UZ8c6I/TWtNYe16v9A38/wp/VZf8APti1NaI5gb/epsXQ/WsseNdFA/5DGnf+Bg/+IqOTxtoqt/yGNPH0vR/8RT+qy/59P8RGxKxCVDEcwN/vVlN400R+uuaaPY3qf1K/y/Gm/wDCZ6KgwutaWR/1+x//ABdP6rL/AJ9MDT3ERN9ahjOQfrVH/hMdHI+XVtMYe14n9A38/wAKj/4S/Rw8jf2nYs0ar8sc6s3JI6sUT81J9+wKmBqtKcVaxjJampnigDFNWSJ2YQyCZVOCwcNzgHtx37VHdDEMjbmVvkC4PXJO78hXK4yk/avoZyqezrpv+U+af+CpnxRj8I/AD+wY2/07xROLIoGwfs/Mjvj2kihXP/TU+tfnGX3qv+yMY9D3/M8/UmvoT/gpD8Zf+FjftDXGm295H/ZvhdBYwAru3zbvMck+h/dg+pjHoK+fZTvnkdl2PIdzAfdz/s+gr8d4oxzxWbuEvhij+d+MM4rY3NXQkvdhdDaWKKa5uYoYI/MmkbZEmM73bAVfx5/Kkr179h34RN8Yv2h9Es3jVrLTZft1yzLkLs5X9c14uCw6xWIhThsfL5bgXmGNp4CG9bRfJ3P0R/Zv+GsPwo+BXhnw+qq/2GzUyuRzJI4LMT6kbiufRQK7OYYf8APyGB+QAH4VJEFES7EWNTnEajCpzjgfhn8aSYfLX7phsN7CjGh/Kj+osPBQoxppaRSX3aEVRT/f/CnxHIP1pk/3/wAK6DfUYGIoqOZiG/Cig5p7lon97+FWVGBVY/678KsA/vB9KDp1HUUS8TL/ALtOlGCPpQGosJ+ap5Rgj6VT3ES/hVjcTIv0oN47E8H3Pxriv2lv+TdfiF/2LGp/+kU9duowK4j9pb/k3X4hf9ixqf8A6RT10x/iUfUo/lauf+PiT60xWKhgOA+AwH8WM4z+Z/M0+5/4+JPrTK/rzDfwY+i/I55bkRsYS2fJiycZOwc4GB+gA/CkbTrdjzbwn6oKmopfVKH8i+5BzSK50m1bra2//fsUDSbUf8utv/37FWKKPqtH+Rfcg5pEcVnDB/q4o0/3VAqUuWjZCSVbGV7HHSkqW3RQC8qS+T03jG0H+dXGhTi7xik/REkTfO25vmO7dk+uAM/XAH5U6IRybopJNnmcjavzJjqxPp/hWl4U8Jal4/8AEFtpOg6beatfXz+WltZWs11NP/dUIo3cnuhU+9fod+w3/wAG8vxD+LepW+u/Fh5Ph54duFAfSl2Pq04GD5YQfNChB/5akyZLZONoHiZzn+DwCdXManM18MVv6GdONWpPlij4/wD2PP2KfHX7c/xOi8O+B9Je4hyGvNTnjMVhp0XQyyyDnB6Iq9WBzwa/og/YD/YM8J/sD/By38O+H4ln1K4AOq6lLCi3V/OVUMXKj7vyjC5xjnqTXdfsz/syeB/2WPhha+FvA/h+w0PTIF2yrEqma5baAWmYDLOQBnOe1ehCJQiqFXbH90Y4X6V+A8WcaYrN6jjShy0+i8vM9KnRdFXluEK7IwpULt44FOo3bqaT+9/Cvj+VNK6OuMuZcxLCfmr5t/4LEcf8E2fi5/2BD/6MSvpGT5WGOOK+a/8AgsCxb/gmt8XP+wK3/oxK6cD/AL3S/wAS/MzrfCfzJzf65/rTadN/rn+tNr+w6fwL0X5HmSvcKKKKoWp+kn/BsF/yfL4r/wCxNuf/AEss6/eRCQor8G/+DYL/AJPl8V/9ibc/+llnX7yL9wV/MPiV/wAj89fBt+yZJbnKH61JUdt9xvrUlfILY2p/CgooopmhA/8Ax+j/AHR/M1+Rn/B1f/yKvwg/7CN5/wCi0r9c3/4/R/uj+Zr8jP8Ag6v/AORV+EH/AGEbz/0WlfUcA/8AJQYX/G/yOefwyPxni/1a/SvvD/g3Q/5SWaH/ANgfUP8A0WtfB8X+rX6V94f8G6H/ACks0P8A7A+of+i1r9y40/5FeK/69/qeHh/40T+hqyGY/wAv5CvkX/gu78v/AATD+JXtb23/AKVwV9d2P+r/AC/kK+RP+C73/KMP4lf9e9t/6VwV/O+T/wC+UfVfofRVPhkfzYJ/qo/dFz78Cu//AGUP+TpPhr/2N2jf+l8NcBH/AKmP/cX+Qrv/ANlD/k6T4a/9jdo3/pfDX9YZl/u9b/D/AO2M8Sj8R/WZZf6j/gTf+hGpqhsv9R/wJv8A0I1NX8ent0/hQUUUUFBRRUczEN+FACT/AH/wplBOaKACiiigAqOZ2DdTUlRT/f8AwoMZbjGG6Jwv+sIPXpja1fzj/wDBe1lP/BUXxxtkjk221iDt6Kfs6cV/Rw/3Pq2D7ja1fzb/APBcONU/4Kn/ABRUKoVZ7MAAcD/Q4a/SPC7/AJG/yOPG/wAM+SZD85+tRzQR3DK0kayMrKylhnBXO0j3GTj0yfWproYlqOv6AnTjOPLNJrzPNpX5UQpptvGMLbwqOvCCl+ww/wDPGL/vgVLRWf1Wh/IvuRpzSITYW5/5Yw/98CkOmWzdbeD/AL9ip6KPqtH+Rfcg5pFf+yrX/n2t/wDv2KDpNqf+XW3/AO/YqxRR9Vo/yL7kHNIgXTLZB8tvAPpGKUWEA/5Yw/8AfAqaij6rR/kX3IOaRCbC3P8Ayxh/74FNfTrdZI2+zw7o8ujbBlWBXBHoR2ParFOIzDJ7Rtj2+7XHisLR9nU9xfC+iC7P6wPhZClt8MPDsUarHHHpsCoijCoNg4A7Vk/tAfE2z+EHwj17xBebitjakRorbWmkf5EVD1UliFyOnmBv4RWp8K2Mnw10Fd20f2ZbmR2PQbRjHuTXxz/wVm+OIu7rRfA1tdbVjjOoazFEDuUbjFFEMd2Vp2YdxGtfyFxFjIYPD1nDdtnkcR5lDA5fLGLe3L8z451zWLrX9Rnvb6Rpr3UHNzcv2lZjkNj3Tacdunaqecge3A9qfOzSP5jNv8z5wc5GD6f565plfz660qj9pPdn8yc9Rvmnuxr4csu7a20sMe1ff/8AwSz+Da+EvhpfeJ76F1vvEjGGKUD5oYFVSpB6jLFxx6V8QfC74e3XxU+JGieHLGMvea1ciFXxxAi4ZyfqDj8K/XbwH4Rs/APgix0bTo/KsbGFYI0xt4Xrkf724/jX2vBWWSqVnWn8KP0bw1ymU8VLM6nww0Xl6GsMtGzMqqzHoB0qEnMZ+tDSMyMdzZz61HEcwN/vV+qTkm7x2P2v2ap+5HYbF0P1pJh8tPhH7lv96oycxn61IalRjk0Uh60UHNPc0pVww47VGXbzhyelOByKMc0HTqWOv5UE5psJyv406gNQxzUsPK1FUsH3PxoN47DjI3m/ebp61m/EHwgnxH8D634dmka3h1rTbiwkkj/1vlzxmGRlHqgcEHturTxzUsA+dZP+WkYZVbuoOMgH32rn1wPStaNTklzMo/NZv+DZT4Xysz/8J54wVZCXQCKAYVjkfeBPQij/AIhkfhf/AND94w/792v+FfpQqhJML8owOBx0GB+QAH0FTSjBH09a92PGWY01yU8TNJdEr/jYND80P+IZP4Wj73j7xl+CW3+FSw/8GxXwpnXcfiB40XnH3bb/AAr9JtxEv3m6etWASHHzN09aP9ds0/6Cp/8AgP8AwA5aP2nqfmn/AMQwnwp/6KD41/75tv8ACj/iGE+FP/RQfGv/AHzbf4V+l0pKzKNzfd9adKcEcnp60f67Zr/0FT/8B/4BtGnQtufmfD/wbE/CpLpN/jvxhcW/Vo99vHI30IHSvSvh/wD8G8n7NvgDUYbq+0PxD4ml4TGrawywqR3/AHePyr7niOXqf/UPuj+RiOSvGa56/E2aV17+Idu+zN4xjbQ4P4Jfsv8Aw7/Z50uWw8F+D9C0OKT5JJreyiWaUYHytKF3Oox/ET3r0CO1WzTZHjaR0HQD0pIPun3OT70+vJqVqlR81SXM+97lrTYAxAx2HSpoTlfxqGnwn5qjmYPXcloxzTpRgj6U2kAE5rgf2m/gPY/tP/AzxN4C1O8msbHxHaC3mliGXC5ycDpngV31B5/A5HtU06k41PaUt4gfl/Zf8Gufwvkh5+IPjQBThcxQhiPfcCT35qb/AIhb/hb/ANFC8Z/9+7b/AOJr9Oicev4Um7/er3FxtmqVliJx8rbfgHs6D+Lc/Mb/AIhb/hb/ANFC8Z/9+7b/AOJo/wCIW/4W/wDRQvGf/fu2/wDia/Tnd/vUbv8Aeo/12zb/AKCp/d/wA9lh+58ZfsG/8EbvCH/BO34wan4u8M+KPE2s32qaLPpjJdxReUimSKTOVGM5j/zxX2jacRsu7d87NndnhiWH6MOKWFQ8fzDPUc09VCD5QB9BXl4jF1MVU9vXk5SfV7m0VFK0diaD7n40+q4YipoTlfxrEod5ir1o3BulBXPagDFACbQWzgZ9cV8tf8FK/wDgmp4Y/wCCjFl4Xs/EWuavo/8AwiUk97bCy8pROzqFIfcMkDHTpX1Nnmmsiv1Cngjkdq1w2MqUKiq0PiiFj8s4f+DXb4WTPIF8feMo/LYBgPs7AkqDxleBz0r2H9h//gh14H/YR+Ptt8QPD/irxRrWqWdlPbx292kXksHAB+7gZ/WvutIwg6D8qR4UaRWKpvTO1iOVz1x9a78TxHmWKhy1quj6E8kb7Fa0VoN8fzDYwGS5bd8oPf8ALHtXl/7ZP7Mmk/th/AfWfh/ruqX+m6bryJHJJaOgkGGDA4Yc4IB+oHpXrSoo7L+VG0V5FKtUhP2lN3aKPy1j/wCDW/4XIvlj4heNtsYCKWjtssAPXbz9a1vh5/wbZ/DL4U/Ejw94ki8beLbq58N6raa1bxSpH5c0lrKJhG5QAFW28g9cV+mbJx8xqvc2sMz/ADRxuxHUqDxyP6n8z617n+tucTpyhUrWT/4Yn2dHqO0wKkUiqxba5ydxbJ4J+nOeKs1DZxLDEVXABYtge/J/Xn8amrxIc3L7zuytFpHYKKKjmYhvwqgCZiG/Coyc0E5ooAKKKKACiiigxluRzMQ34VGTmnz/AH/wplBJT1FHnnVY5HRvLZMBsKQ+AX+q7eD23H1r4R/a2/4IN/D/APbI/aD8QfEjVvF3ijSb/wASSRu8FoYmjAjjSIH5wTzszxx+tfelwoaQHAyAQDjoD1/OmofKRVX5VUYAHAFdGFzCthZ8+HbUvIxlq9T8xv8AiF8+Fjct8QPG3/fNt/8AE0o/4NevhX2+IXjT8Utv/ia/ToktH95uvrUSAuDlmPPrXpf635t/0Ezj5JbfgTyo/Mr/AIhevhb/ANFC8Zf98W3/AMTR/wAQvXwt/wCiheMv++Lb/wCJr9N9n1/Ojb9fzo/12zVafWp/+A/8AOVH5iS/8GwHwtjbH/CwvGX/AHxbf/E03/iGE+FX8XxC8afgtt/hX6b3ESs/4UwRhenFbR4wzZq6xU//AAH/AIBP1e+p+Zf/ABDCfCn/AKKD41/75tv8KP8AiGE+FP8A0UHxr/3zbf4V+mMvyt1b86ZuPq351X+uuarT61P/AMB/4A/Z0VpJ6n5mzf8ABsN8Kg3/ACULxt0/u23+FJ/xDH/CuGL/AJH7xo3PUrbf/E1+mMx+XqfzqvE7FT8zdfWj/XbNP+gqf/gP/AMpRin7ux+aUf8AwbKfC9gdvj7xl17pbf8AxNB/4Nl/hdbLJK3j/wAYxyKhKF0tmhf+HaRt9XX8h6V+l+ajlYrKGHDAYyOvUH+YB/AVtHi3N503Cdd2l1ejfqToZ/hrQYfD2gWejxyTXVjaRQxRTvIruxRFZXO0DAOcY9q8O+Kn/BOzwr8WfiPq3ibVNT14ahrFwLiVYbxUSJghQBQ2SMKW6cYdvU5+grc7UbHG7CtjuAMAH6UTSsr/AHm596+QxVGjXXJiYOXd9zlxmAoYinyYqHPDsj5ai/4JO/DyOML9s8RKo6AXCsB/3zgU2f8A4JSfDzbtXVvEsLHpiSIj/wAfBP8ASvqRv3se5vmbOMnmqp4rzo8O5bbTDxfm5WfzR4n+q+Tv4cLTS/vc3N8/M8P+AX7BfhT9nj4gHXNPvr7Ub6WLyYzeFGWDknK7RgHnr1/SvcnyrMpfzGU4Z8/fPqaaw3LtPK+hpFRUHyqF+gr0sPh6eChy04qKeyWq+89XD4Wlh6fsaEIxj2jt/XqRzcNTBwKfP9/8KZWxvqOAxCfrUB/1bfWlmdg3U00f6k/WgNSqetFB60UHNPcvQnK/jTqZB9z8aUn97+FB0RvYng+5+NPpg4kH0p8vEy/7tA9Qp8J+aklGCPpTQcUG8di1KMEfSnwfc/Gq0Tsz8kmpJGKzKBwNvagosY5oJzQOlFVzNbAGOalh5Woqlg+5+NHNLubRirDzyakiG5eefrUdPhPzUc0u4+VEoUDtQTmnSjBH0qMn97+FQ0nuMng+5+NKT+9/CmSHaRjjjtToeVp7aI2jsSyjBH0poOKCc0UFE0TFl55+tOquGIqaE5X8aAHUUUULTYAqSFcr071HQGIp3YrIn2L/AHR+VGxf7o/KkhOV/GnUczNoxVtgAxRRRSLCgMRRRQBNDKAvzevenbg3Sq9AYigCxRUIuNnX9akik8xc+9G2wDqMZoopcqe4BjFFFFNabAGM03y1J+6v5U7zFXrUctyqt2pOKe4WRIBijzFXrUJm39P0ppOaYEk0mW+X07VGTmiigAooooAKKKKACo5mIb8KJmIb8KjJzQYy3AnNFFFBIFc9qTYPQflS1HMxDfhQAkww1MAxQTmiq5mAU2U4SnVHOfm/CjmYEMbFgc8896dQBiijml3MZPUCue1QzDDfhTpmIb8Kb1i/Gjml3JshpGahlUK3Ax9KcWPln61DGxYHPPPejml3MZbjqCue1OA/dfjUcRyD9al67kkiqBF071AeYz9aWZ2DdTUeeKd3sOMmtUR728o8nrUMZyD9alm4amAYqOSL1aE227scB+6/Gmxcwt/vUZ4psh2x8cc9qrpY55XuMPMZ+tRRHIP1oiYlT9acBigWpFP9/wDCopWISp5h8tU2Yk0HPJu4yM5B+tFTQKNvQdfSiggsjiQfSpZVww47UUUHVHYbuOamiO4ZPJ96KKChxOaKKKDaOxJAPl/GpDyaKKCiaE5X8adRRQAUBiKKKAJoTlfxpwOKKKDaOxNExZeefrTsc0UUFATmpYPufjRRQbR2H0UUUFBUsH3PxoooAfRRRQAUUUUAAYipoTlfxoooAdRRRQbR2CiiigoKKKKAArntQp2jjj6UUUALvb1NG9vU0UUAG9vU0b29TRRQAhOaCue1FFAABiiiigAooooAKKKKDGW4VHMxDfhRRQTcjJzRRRQAUUUUAFRT/f8AwoooAZRRRQA2U4Sq8bFgc8896KKAHUUUUGMtyKf7/wCFMzxRRQSRTcNTAMUUUGMtwzxQBiiigkin+/8AhSAfuvxoooArMcmkoooAKjnPzfhRRQYy3IwMU2U4SiigkhiYtA2efm71XPWiig5anxAGIooooJP/2Q==" />
              <br>
              <b style="color: #313dc4;">Mailing Address: </b> 32, Naya Paltan <br> (1ar
              Floor),D.I.T.
              Ext. Road, Dhaka-1000 <br>
              Mobile: 01324-410333, 01776-298865
            </div>
            <div class="col-8">
              <div class="text-center">
                <h2 style="margin: 0;text-align:center ;">DHAKA HOMOEO HALL (PVT.) LIMITED</h2>
                <p style="text-align:center; font-weight: 700; margin: 0px;">Manufacturer of
                  Homoeopathic
                  Medicine (Since 1982)</p>
                <hr class="firstHr">
              </div>
              <div class="text-right">
                <b>Laboratory: </b> Nolsata, Demra <br>
                Dhaka-1361, Bangladesh <br>
                Mobile: 0132410325,01980458290
              </div>
            </div>
          </div>
          <div>
            <hr class="hrOne">
            <hr class="hrTwo">
          </div>
          <div class=" displayToggle" style="padding: 10px 20px">
            <div class="row">
              <div class="col-4">
                <b>REF:</b>
              </div>
              <div class="col-8 text-right">
                <b>Date:</b> <sub>.........................................................</sub>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="watermarkOnPrint">
        @yield('content')
      </div>
    <div class="printFooter">&nbsp;</div>
      @include('admin.layouts.adminFooter')

    </div>

    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    {{--
    <!-- jQuery -->
    <script src="{{ asset('cp/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <!-- overlayScrollbars -->
    <script src="{{ asset('cp/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('cp/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <!-- AdminLTE App -->
    <script src="{{ asset('cp/dist/js/adminlte.min.js') }}"></script>
    <script src="{{asset('js/custom.js')}}"></script> --}}
    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
    <script src="{{asset('js/admin.js')}}"></script>

    {{-- <script type="text/javascript">
      $(document).ready(function() {



/////////////////////admin search start///////////////////

        var delay = (function(){
        var timer = 0;
        return function(callback, ms){
          clearTimeout (timer);
          timer = setTimeout(callback, ms);
        };
        })();


///////////////////////


$(document).on('click', '.ajax-pagination-area .pagination li a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');

    $.ajax({
      url: url,
      type: 'GET',
      cache: false,
      dataType: 'json',
      success: function(response)
      {
        $(".ajax-data-container").empty().append(response.page);
      },
      error: function(){}
    });

        });

  //////////////////////

    $(document).on('keypress', '.ajax-data-search', function(e) {
        if(e.which == 13) {
            e.preventDefault();
        }
    });

//////////////////////

    $(document).on("keyup", ".ajax-data-search", function(e){
    e.preventDefault();

    var that = $( this );
    var q = e.target.value;
    var url = that.attr("data-url");
    var urls = url+'?q='+q;


    delay(function(){
    $.ajax({
      url: urls,
      type: 'GET',
      cache: false,
      dataType: 'json',
      success: function(response)
      {
        $(".ajax-data-container").empty().append(response.page);
      },
      error: function(){}
    });
    }, 200);
  });
//////////////////////admin search end //////////////////


///////////////////data delete ajax start


$(document).on('click', '.data-delete-ajax', function(e) {
        e.preventDefault();

        var that = $(this);

        var url = that.attr('href');

    $.ajax({
      url: url,
      type: 'GET',
      cache: false,
      dataType: 'json',
      success: function(response)
      {
        that.closest(".data-item").remove();
      },
      error: function(){}
    });

        });

  //////////////////////

    ////////////////////////////
//data delete ajax end



});

    </script> --}}

    {{-- <script>
      var x = document.getElementById('demo');
    setInterval(function(){

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
        function showPosition(position) {
          x.innerHTML = "Latitude: " + position.coords.latitude +
          "<br>Longitude: " + position.coords.longitude;
        }
      }

    }, 3000);


    </script> --}}

    @stack('js')




</body>

</html>
