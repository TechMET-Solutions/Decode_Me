@extends('user.layout.master')
@section('content')
    <style>
        .profileData li h5,
        p {
            font-family: 'Rubik';
        }

        p {
            font-family: 'Rubik';
        }
    </style>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="card p-3" style="overflow: hidden;border-radius:24px; background:#fff">
                            <div class="d-flex">
                                <a href="{{ route('myProfile') }}"><i class="fa-solid fa-arrow-left fa-2x"
                                        style="color: #1F1F1F"></i></a>&nbsp;&nbsp;
                                <p
                                    style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                                    Complete Profile </p>
                            </div>
                            <div style="width:50px; border-top: 4px solid yellow;margin-top:-30px;margin-left:250px;">
                            </div>
                            <div class="container">
                                <form action="{{ route('completeProfileData') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="stud_id" value="{{ Auth::user()->id }}">
                                        @if ($profileData)
                                            <div class="col-lg-6">
                                                <div class="mt-3 mb-3">
                                                    <label for="studWant" class="form-label">What does the student want to
                                                        become? <br>
                                                        (Mention all the options)
                                                    </label>
                                                    <input type="text" name="studWant" placeholder="Add Options"
                                                        class="form-control" id="studWant"
                                                        style="border:1px solid #FDD901;" required
                                                        value="{{ $profileData->studWant }}">
                                                </div>
                                                <div class="mt-3 mb-3">
                                                    <label for="fathWant" class="form-label">What does the father / guardian
                                                        want the student to become? <br>
                                                        (Mention all options)
                                                    </label>
                                                    <input type="text" name="fathWant" placeholder="Add Options"
                                                        class="form-control" id="fathWant"
                                                        style="border:1px solid #FDD901;"
                                                        value="{{ $profileData->fathWant }}" required>
                                                </div>
                                                <div class="mt-3 mb-3">
                                                    <label for="mothWant" class="form-label">What does the mother / guardian
                                                        want the student to become?
                                                        (Mention all options)
                                                    </label>
                                                    <input type="text" name="mothWant" placeholder="Add Options"
                                                        class="form-control" id="mothWant"
                                                        style="border:1px solid #FDD901;"
                                                        value="{{ $profileData->mothWant }}" required>
                                                </div>
                                                <div class="mt-3 mb-3">
                                                    <label for="studDream" class="form-label">What’s your (the students)
                                                        ultimate dream in life?
                                                    </label>
                                                    <textarea name="studDream" placeholder="Write" class="form-control" id="studDream"cols="30" rows="7"
                                                        style="border:1px solid #FDD901;height:170px;" required>{{ $profileData->studDream }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mt-3 mb-3">
                                                    <label for="familyIncome" class="form-label">Annual Family Income
                                                        (Black+White)
                                                    </label>
                                                    <input type="text" name="familyIncome" placeholder="Add Income"
                                                        class="form-control" id="familyIncome"
                                                        style="border:1px solid #FDD901;"
                                                        value="{{ $profileData->familyIncome }}" required>
                                                </div>
                                                <div class="mt-3 mb-3">
                                                    <label for="outcome" class="form-label">What outcome are you expecting
                                                        out of this conversation?
                                                    </label>
                                                    <textarea name="outcome" placeholder="Write" class="form-control" id="outcome"cols="30" rows="7"
                                                        style="border:1px solid #FDD901;height:170px;" required>{{ $profileData->outcome }}</textarea>
                                                </div>
                                                <div class="mt-3 mb-3">
                                                    <label for="otherInfo" class="form-label">Please share any other
                                                        information about you which will help
                                                        us study your profile better.
                                                    </label>

                                                    <textarea name="otherInfo" placeholder="Write" class="form-control" id="otherInfo"cols="30" rows="7"
                                                        style="border:1px solid #FDD901;height:170px;" required>{{ $profileData->otherInfo }}</textarea>
                                                </div>
                                                <div class="mt-3 mb-3">
                                                    <label for="doAcademic" class="form-label">What do you do
                                                        beyond academics?
                                                    </label>

                                                    <textarea name="doAcademic" placeholder="Write" class="form-control" id="doAcademic"cols="30" rows="7"
                                                        style="border:1px solid #FDD901;height:170px;" required>{{ $profileData->doAcademic }}</textarea>
                                                </div>
                                            </div>
                                    </div>
                                    {{--  <div class="text-center mt-4">
                                        <button class="btn btn-success"
                                            style="background:#71BF0D;color:#fff;width:20%;">Complete
                                            Profile</button>
                                    </div>  --}}
                                @else
                                    <div class="col-lg-6">
                                        <div class="mt-3 mb-3">
                                            <label for="studWant" class="form-label">What does the student want to
                                                become? <br>
                                                (Mention all the options)
                                            </label>
                                            <input type="text" name="studWant" placeholder="Add Options"
                                                class="form-control" id="studWant" style="border:1px solid #FDD901;"
                                                required>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="fathWant" class="form-label">What does the father /
                                                guardian
                                                want the student to become? <br>
                                                (Mention all options)
                                            </label>
                                            <input type="text" name="fathWant" placeholder="Add Options"
                                                class="form-control" id="fathWant" style="border:1px solid #FDD901;"
                                                required>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="mothWant" class="form-label">What does the mother /
                                                guardian
                                                want the student to become?
                                                (Mention all options)
                                            </label>
                                            <input type="text" name="mothWant" placeholder="Add Options"
                                                class="form-control" id="mothWant" style="border:1px solid #FDD901;"
                                                required>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="studDream" class="form-label">What's your (the student's)
                                                ultimate dream in life?
                                            </label>
                                            <textarea name="studDream" placeholder="Write" id="studDream"cols="73" rows="7"
                                                style="border:1px solid #FDD901;height:100px;" required></textarea>
                                            {{--  <input type="text" name="studDream" placeholder="Write"
                                                class="form-control" id="studDream"
                                                style="border:1px solid #FDD901;height:100px;" required>  --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-3 mb-3">
                                            <label for="familyIncome" class="form-label">Annual Family Income
                                                (Black+White)
                                            </label>
                                            <input type="text" name="familyIncome" placeholder="Add Income"
                                                class="form-control" id="familyIncome" style="border:1px solid #FDD901;"
                                                required>
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="outcome" class="form-label">What outcome are you
                                                expecting
                                                out of this conversation?
                                            </label>
                                            <textarea name="outcome" placeholder="Write" id="outcome"cols="73" rows="7"
                                                style="border:1px solid #FDD901;height:100px;" required></textarea>
                                            {{--  <input type="text" name="outcome" placeholder="Write"
                                                class="form-control" id="outcome"
                                                style="border:1px solid #FDD901;height:100px;" required>  --}}
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="otherInfo" class="form-label">Please share any other
                                                information about you which will help
                                                us study your profile better.
                                            </label>
                                            <textarea name="otherInfo" placeholder="Write" id="otherInfo"cols="73" rows="7"
                                                style="border:1px solid #FDD901;height:100px;" required></textarea>
                                            {{--  <input type="text" name="otherInfo" placeholder="Write"
                                                class="form-control" id="otherInfo"
                                                style="border:1px solid #FDD901;height:100px;" required>  --}}
                                        </div>
                                        <div class="mt-3 mb-3">
                                            <label for="doAcademic" class="form-label">What do you do
                                                beyond academics?
                                            </label>
                                            <textarea name="doAcademic" placeholder="Write" id="doAcademic"cols="73" rows="7"
                                                style="border:1px solid #FDD901;height:100px;" required></textarea>
                                            {{--  <input type="text" name="doAcademic" placeholder="Write"
                                                class="form-control" id="doAcademic"
                                                style="border:1px solid #FDD901;height:100px;" required>  --}}
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button class="btn btn-success"
                                            style="background:#71BF0D;color:#fff;width:20%;">Complete
                                            Profile</button>
                                    </div>
                                    @endif
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
