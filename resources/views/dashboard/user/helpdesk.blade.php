@extends('layouts.app')
@section('title', 'Help Desk')
@section('main')

<div class="auth-header">
    <div class="help-head d-flex">
        <a href="{{ url()->previous() }}"> <i class="back-btn" data-feather="arrow-left"></i>
            <h2> <img src="{{ asset('assets/feather/arrow-left.svg') }}" /> Help Center</h2>
        </a>
    </div>
    <div class="head-img text-center">
        <img class="img-fluid img2" src="{{ asset('assets/images/authentication/help.svg') }}" alt="v1" />
    </div>
</div>
<form class="auth-form" target="_blank">
    <div class="custom-container">
        <div class="help-center">
            <h2 class="fw-semibold">HELPDESK</h2>
            <div class="accordion accordion-flush help-accordion" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">What is {{ env('APP_NAME') }}?</button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            {{ env('APP_NAME') }} is your go-to platform for effortless bill payments and financial services. Whether you're paying for utilities, airtime, data subscriptions, or other essential services, {{ env('APP_NAME') }} ensures fast, secure, and hassle-free transactions. Imagine never having to worry about long queues or complicated processes again!

                            <br><br>
                            But that's not all—{{ env('APP_NAME') }} also offers exciting commission opportunities! By simply using the platform or introducing others to its benefits, you can earn rewards with every transaction. It’s not just about convenience; it’s about making every payment work for you. Whether you're an individual looking for a smooth way to manage bills or a business seeking to offer value-added services to customers, {{ env('APP_NAME') }} empowers you to do more.

                            <br><br>
                            Why choose {{ env('APP_NAME') }}? Our user-friendly interface makes it easy to navigate, while secure payment processing ensures your data and funds are always safe. Plus, with a wide range of payment options, there's no limit to the convenience you can enjoy. For our loyal users, this is your chance to explore even more rewards and ease. For new users, welcome to a smarter way of handling payments!

                            <br><br>
                            Streamline your payments, earn rewards, and experience a new level of convenience. Start using {{ env('APP_NAME') }} today and unlock the potential for more efficiency and earnings with every transaction.
                        </div>
                    </div>

                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            How do I fund my account?
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            Funding your {{ env('APP_NAME') }} account is easy! Just follow these steps:

                            <ul>
                                <li>Log in to your account through our app.</li>
                                <li>Click on the 'Fund Wallet' option.</li>
                                <li>Create a virtual account by using your NIN or BVN to generate it.</li>
                                <li>Transfer funds to the virtual account number provided for instant funding.</li>
                                <li>A 3.5% transaction fee applies to each transfer.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour">How can I purchase data?</button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            Purchasing data is simple! Just follow these steps:
                            <ul>
                                <li>Log in to your account on our mobile app.</li>
                                <li>Navigate to the 'Data' section.</li>
                                <li>Select your desired network provider.</li>
                                <li>Enter the phone number you wish to recharge.</li>
                                <li>Choose the data package you want to purchase.</li>
                                <li>Confirm the transaction, and you'll instantly receive your data.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive">
                            How can I transfer my commission to my wallet?
                        </button>
                    </h2>
                    <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            To transfer your commission to your wallet, follow these steps:
                            <ul>
                                <li>Sign in to your account and navigate to the 'Transfer Balance' section.</li>
                                <li>Select the type of transfer you want to make.</li>
                                <li>Enter the amount of commission you wish to transfer.</li>
                                <li>Proceed to confirm and complete the instant transfer to your main wallet.</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
<x-footerMenu />
<section class="panel-space"></section>

@endsection