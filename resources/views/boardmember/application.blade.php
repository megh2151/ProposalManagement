@extends('layouts.user.app')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-lg-10 about-card">
        <h5 class="section-title text-center">Please read before joining.</h5>
        <h5 class="section-title text-center">Join our advisory board.</h5>
        <p>Dear (Prospective Board Member's Name),</p>
        <p>I am writing to invite you to join the advisory board of Letter to AsoRock, an initiative to submit ideas and proposals to the new government of Nigeria.</p>
        <p>Letter to AsoRock was created in response to the president's call for mindset change and patriotism during his campaign. He urged us to ask what we can do for our country. The citizens have valuable ideas that can improve Nigeria but may not have access to government agencies that can implement them. That's why we built a portal that allows citizens to submit their ideas or proposals in a transparent and efficient way, bypassing the bureaucratic process. This way, we can connect with the government and bring positive change to our country.</p>
        <p>As a professional heading an (industry/sector) in Nigeria, you have the experience and insight that we need to shape our initiative and make it more impactful. You are also a high achiever who has demonstrated excellence and leadership in your field. We are looking for people like you who are passionate about Nigeria and want to contribute to its development.</p>
        <div class="row">
        <p>By joining our advisory board, you will have the opportunity to:</p>
        <p></p>
        </div>
        <div class="row">
            <ul class="list">
                <li>Share your expertise and advice with us and other board members</li>
                <li>Network with other influential and like-minded professionals</li>
                <li>Influence the direction and strategy of Letter to AsoRock</li>
                <li>Help us reach out to more citizens and government officials</li>
                <li>Enhance your reputation and visibility as a thought leader and a patriot</li>
                <li>Enhance your reputation and visibility as a thought leader and a patriot</li>
            </ul>  
        </div>  
        <p>The advisory board will meet quarterly via online platforms for about an hour. The term of service is one year, renewable upon mutual agreement. We will cover any expenses you incur from attending the meetings and also offer a $500 honorarium to be paid directly to you or to a charity of your choice.</p>
        <p>If you are interested in joining our advisory board, please submit a biography of yourself not to exceed 100 words and a profile passport photograph of yourself.</p>
        <p>We hope you will accept our invitation and join us in this exciting endeavor. Please let us know if you have any questions or concerns.</p>
        <p>Sincerely,</p>
        <p>Dr. Peter Ojo</p>
        <p></p>
        <form class="text-center" method="get" action="{{route('join-board-form')}}">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="agree" required>
                    <label class="form-check-label" for="agree">I agree.</label>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Join</button>
            </div>
        </form>
    </div>
    
</div>

@endsection