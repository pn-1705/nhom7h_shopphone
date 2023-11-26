@extends('User.master')
<?php
    $nganhang=\Illuminate\Support\Facades\DB::table('nganhang')
        ->get();
    $lichsunap=\Illuminate\Support\Facades\DB::table('lichsunap')
        ->where('idnd','=',\Illuminate\Support\Facades\Auth::user()->id)
        ->get();
    $ndck = \Illuminate\Support\Facades\Auth::user()->id.'_'.strtoupper(\Illuminate\Support\Str::random(5));

?>
@section('head')
    <style>
        @media (max-width:768px) {
            html {
                height: 100%;
                overflow: unset;
            }

        }

        @media (min-width:768px) {
            .card-momo {
                opacity: 0;
            }
        }

        @media (min-width:768px) {
            .card-momo {
                opacity: 0;
            }
        }

        .card-momo {
            font-size: 16px;
        }

        .card-momo a {
            color: #f44336;
        }

        .btn-primary {
            border-color: #f44336 !important;
            color: #fff !important;
        }

        .border-primary {
            border-color: #f44336 !important;
        }

        .bg-primary,
        .btn-primary {
            background-color: #f44336 !important;
        }

        .btn-outline-primary:hover {
            background-color: #f44336;
            border-color: #f44336;
        }

        .btn-outline-primary {
            color: #f44336;
            border-color: #f44336;
        }

        .feature-box {
            padding: 38px 30px;
            position: relative;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 0 29px 0 rgb(18 66 101 / 8%);
            transition: all 0.3s ease-in-out;
            border-radius: 8px;
            z-index: 1;
            width: 100%;
        }

        .feature-icon {
            font-size: 1.8em;
            margin-bottom: 1rem;
        }

        .feature-title {
            font-size: 1.2em;
            font-weight: 500;
            padding-bottom: 0.25rem;
            text-decoration: none;
            color: #212529;
        }

        .list-group-item.active {
            background-color: #007bff;
            border-color: #007bff;
        }

        a {
            text-decoration: none;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #007bff;
        }

        .nav-link {
            color: #007bff;
        }

        .nav-link:focus,
        .nav-link:hover {
            color: #cd3a2f;
        }

        #status-the {
            position: relative;
            top: -50px;
            left: calc(50% - 50px);
        }

        .hidden {
            display: none;
        }

        .configure-border-1 {
            width: 50px;
            height: 50px;
            padding: 3px;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fb5b53;
            animation: configure-clockwise 3s ease-in-out 0s infinite alternate;
        }

        .configure-border-2 {
            width: 50px;
            height: 50px;
            padding: 3px;
            left: -50px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgb(63, 249, 220);
            transform: rotate(45deg);
            animation: configure-xclockwise 3s ease-in-out 0s infinite alternate;
        }

        .configure-core {
            width: 100%;
            height: 100%;
            background-color: #1d2630;
        }

        @keyframes configure-clockwise {
            0% {
                transform: rotate(0);
            }

            25% {
                transform: rotate(90deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(270deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes configure-xclockwise {
            0% {
                transform: rotate(45deg);
            }

            25% {
                transform: rotate(-45deg);
            }

            50% {
                transform: rotate(-135deg);
            }

            75% {
                transform: rotate(-225deg);
            }

            100% {
                transform: rotate(-315deg);
            }
        }

        .bank-img {
            max-width: 300px;
            display: block;
            margin: 0 auto;
            border-radius: 10px;
            margin-bottom: 20px;
            /* Căn giữa theo chiều ngang */
        }

        .bank-content {
            font-size: 20px;
            font-weight: bold;
            color: #f44336
        }

        .momo-container {
            margin-top: 20px;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            /* Điều chỉnh chiều cao tùy ý */
        }

        .input-copy {
            display: grid;
            grid-template-columns: 8fr 1fr;
            align-items: center;
        }

        .btn-copy {
            margin-left: 10px;
            font-size: 20px;
            cursor: pointer;
            color: #f44336;
        }
    </style>
@endsection
@section('content')
        <div class="container py-3">
            <form method="POST" action="/xacnhannap" id="myform">
                @csrf
                <tbody>
                <label>Tài Khoản: </label><br>
                <input type="text" class="form-control form-control-alternative"
                       style="background-color: #DCDCDC; font-weight: bold; color: #696969" name="username"
                       value="<?php echo \Illuminate\Support\Facades\Auth::user()->id; ?>" readonly required>
                <label>Ngân hàng: </label><br>
                <select class="form-control form-control-alternative" id="bank" name="bank">
                    @foreach($nganhang as $nh)
                        <option value="{{$nh->tennganhang}}">{{$nh->tennganhang}}</option>
                    @endforeach
                </select>
                <label>Giá trị: </label><br>
                <select class="form-control form-control-alternative" name="amonut">
                    <option value="10000">10.000</option>
                    <option value="20000">20.000</option>
                    <option value="30000">30.000 </option>
                    <option value="50000">50.000</option>
                    <option value="100000">100.000</option>
                    <option value="200000">200.000</option>
                    <option value="300000">300.000</option>
                    <option value="500000">500.000</option>
                    <option value="1000000">1.000.000</option>
                    <option value="2000000">2.000.000</option>
                    <option value="3000000">3.000.000</option>
                    <option value="4000000">4.000.000</option>
                    <option value="5000000">5.000.000</option>
                    <option value="6000000">6.000.000</option>
                    <option value="7000000">7.000.000</option>
                    <option value="8000000">8.000.000</option>
                    <option value="9000000">9.000.000</option>
                    <option value="10000000">10.000.000</option>
                </select>
                </tbody>
                <div class="momo-qr">
                    <img class="bank-img" id="bank_img" src='{{ asset("storage/img/BANK/VIETTINK.jpg") }}'/>
                </div>


                <h5 style="text-align: center">
                    Ngân hàng: VIETTINBANK<br/>
                    Số tài khoản: 104872499117<br/>
                    Tên chủ thẻ: LE VAN LONG<br/>
                </h5><br>
                <label class="bank-content">Nội dung chuyển khoản: </label><br>
                <div class="input-copy">
                    <input type="text" class="form-control form-control-alternative content-momo" style="background-color: #DCDCDC; font-weight: bold; color: #696969;" name="ndck" value="{{$ndck}}" readonly required>
                    <i class="fas fa-copy btn-copy" onclick="copyTextContent()"></i>
                </div>
                <div class="center">
                    <button type="submit" class="btn btn-outline-primary mt-2" >Xác nhận đã nạp</button>
                </div>
            </form>
            <hr>
            <h2 class="fw-light">Lịch sử</h2>
            <div class="card-body">
                <table class="table table-bordered blueTable my-table">
                    <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã giao dịch</th>
                        <th scope="col">Số tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $stt=1;
                            ?>
                        @foreach($lichsunap as $lsn)
                            <?php

                                $lsn->trangthai==1?$status_text="Thành công":($lsn->trangthai==0?$status_text="Đang xử lý":$status_text="Thất bại");
                                ?>
                            <tr>
                                <td>{{$stt}} </td>
                                <td>{{$lsn->ndck}}</td>
                                <td>{{ number_format($lsn->giatri, 0, ',', '.') }} VNĐ</td>
                                <td>{{$status_text}} </td>
                                <td>{{date_format(new DateTime($lsn->ngay), 'H:i:s d/m/Y ')}} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br><br>
            <div>- Hãy Kiểm Tra Kĩ Thông Tin Trước Khi Nạp</div>
            <div>- Nạp Sai Mệnh Giá, Thông Tin Thẻ Admin Không Chịu Trách Nhiệm.</div>
            <div>- Quá 30 Phút Thẻ Chưa Duyệt Hãy Báo Ngay Cho Admin Để Được Hỗ Trợ Nhanh Nhất!</div>
            </form>
        </div>
        </div>
        <div id="status">
        </div>
        <div id='stars'></div>
        <div id='stars2'></div>
        <div id='stars3'></div>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script>
        function copyTextContent() {
            var input = document.getElementsByName("ndck")[0];
            input.select();
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
            alert("Đã sao chép nội dung: " + input.value);
        }
        function changeIMG(string) {
            var img= document.getElementById('bank_img');
            img.src = string;
        }
        window.addEventListener('load', function() {
            var $select1 = document.getElementById('bank');
            var $select2 = document.getElementById('amount');
            var bank = {!! json_encode($nganhang) !!};
            $select1.addEventListener('change', function(event) {
                var value1 = $select1.selectedIndex;
                var string = '{{ asset("storage") }}' + bank[value1].maqr; // Assuming "store" is the correct path
                changeIMG(string);
            });
            {{--$select2.addEventListener('change', function(event) {--}}
            {{--    var value1= $select1.selectedIndex;--}}

            {{--    var string= 'https://api.vieqr.com/vietqr/'+bank[value1].tennganhang+'/'+bank[value1].stk+'/'+$select2.value+'/full.jpg?NDck={{$ndck}}&FullName=LE%20VAN%20LONG';--}}
            {{--    console.log(string);--}}
            {{--});--}}
        });
    </script>
@endsection

