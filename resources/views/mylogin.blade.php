{{--@extends('welcome')--}}

<div>
    <form method="POST" action="{{ route('mylogin') }}" class="form-signin">

        {{ csrf_field() }}

        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Email address</label>
            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg rounded-r-md focus:border-blue-300"
                   placeholder="Enter a valid email address" />
        </div>

        <div>
            <span class="font-semibold -mr-0">remember me</span>
            <input type="checkbox" name="rememberMe">
        </div>



        <br>
        <br>

        <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">
                Login
            </button>
        </div>

    </form>

</div>
<script>
    import Checkbox from "@/Components/Checkbox";
    export default {
        components: {Checkbox}
    }
</script>
