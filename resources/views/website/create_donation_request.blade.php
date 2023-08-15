<x-master>


    <body class="create">

        @if (Session::has('success'))
            <br>
            <div class="alert alert-success">
                <b>{{ Session::get('success') }}</b>
                </div>
          
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!--form-->
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    <form method="POST" action="{{ url('web/store-donation-request') }}">
                        @csrf

                        <input type="text" name="patient_name" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="اسم المريض">

                        <input type="text" name="patient_phone" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder=" رقم المريض">

                        <input placeholder=" اسم المستشفى" class="form-control" type="text" id="hospital_name"
                            name="hospital_name">



                        <select name="blood_type_id" id="blood_type_id">
                            <option hidden disabled selected value> -- اختر فصيلة دم -- </option>
                            @foreach ($blood_types as $blood_type)
                                <option value="{{ $blood_type->id }}"> {{ $blood_type->name }}</option>
                            @endforeach
                        </select>

                        <br>

                        <livewire:governorate />



                        <input type="text" name="hospital_address" class="form-control" id="exampleInputEmail1"
                            placeholder="عنوان المستشفى ">

                        <input placeholder="عدد اكياس الدم" class="form-control" type="number" id="bags_num"
                            name="bags_num">

                        <input type="number" name="patient_age" class="form-control" id="exampleInputPassword1"
                            placeholder="عمر المريض ">



                        <textarea rows="4" cols="50" placeholder="تفاصيل" class="form-control" id="details" name="details"></textarea>


                        <div class="create-btn">
                            <input type="submit" value="إنشاء">
                        </div>
                    </form>


                </div>
            </div>
        </div>


        @livewireScripts

    </body>

</x-master>
