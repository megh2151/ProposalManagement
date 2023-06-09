@extends('layouts.user.app')

@section('content')
<div class="container d-flex align-item-center justify-content-center py-5">
    <div class="faq-card col-lg-8">
        <h2>FAQs</h2>
        <div class="mt-4">
            <button class="btn btn-que" type="button" data-toggle="collapse" data-target="#question1" aria-expanded="false" aria-controls="question1">
                A - What is the purpose of this platform?
                <i class="mdi mdi-chevron-down"></i>
                <i class="mdi mdi-chevron-up"></i>
            </button>

            <div class="collapse" id="question1">
                <div class="card card-body">
                    <p>This portal is a citizen-led initiative to support the government's success. We understand that the government comprises people who need input from the citizens they serve. We also believe that the citizens have innovative ideas that can benefit Nigeria, but they may face challenges in contacting the relevant government agencies.</p>
                    <p>That's why we created this portal to enable citizens to present their ideas or proposals in a professional and appealing way without going through bureaucratic hurdles. We aim to facilitate the connection between the citizens and the government and foster positive change in our country.</p>
                    <p>If you have an idea or proposal that you think is suitable for Nigeria, we invite you to share it with us. Your idea or proposal can be for any sector or industry. However, before you submit your idea or proposal, please note that:</p>
                    <ul>
                        <li> You agree to let us share your idea or proposal with the government agencies that may be interested in it.</li>
                        <li>You agree to hold us harmless if your idea or proposal is rejected or used without your consent.</li>
                    </ul>
                    <p>We appreciate your contribution and hope this portal will help you make a difference in Nigeria.</p>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-que" type="button" data-toggle="collapse" data-target="#question2" aria-expanded="false" aria-controls="question2">
            B - What are the tips for writing a good letter/proposal to the government?
                <i class="mdi mdi-chevron-down"></i>
                <i class="mdi mdi-chevron-up"></i>
            </button>

            <div class="collapse" id="question2">
                <div class="card card-body">
                    <h5><strong>Example 1</strong></h5>
                    <ol>
                        <li>Identify yourself and your organization. In the first paragraph of your letter, you should introduce yourself and your organization and explain why you are interested and qualified to share your ideas with the government. You can also mention any relevant background or experience you have in the sector you are addressing.</li>
                        <li>Identify the government official or department you are writing to. In the second paragraph, you should state the name and title of the government official or the name of the department you are writing to and explain why you have chosen them as your recipient. You should also mention how you obtained their contact information.</li>
                        <li>State your purpose and main idea for the letter. In the third paragraph, you should clearly state your letter and your main idea or suggestion for building a new or improving existing infrastructure. You should also mention how your idea aligns with the government's goals and priorities for the sector.</li>
                        <li>Provide details and evidence to support your idea. In the next section, you should elaborate on your idea and provide specific details and evidence to show how it will benefit the public and address the current challenges or gaps in the infrastructure. You can use facts, figures, examples, testimonials, or other relevant information to support your idea. You can use bullet points or subheadings to organize this section.</li>
                        <li>Request a response or a meeting. In the last paragraph, you should thank the government official or department for their time and attention and request a response or a meeting to discuss your idea further. You should also express your willingness and availability to provide more information or clarification if needed. You should provide your contact details and sign off with a professional closing.</li>
                        <li>Format your letter. You should use a clear and professional font, such as Times New Roman or Arial, and a font size of 12 points. You should also use proper spacing, margins, headings, and alignment for your letter. You should follow the instructions and guidelines provided by the government for submitting your letter, such as the number of copies, packaging, email subject line, etc.</li>
                    </ol>
                    <p>Here is an example of a letter with ideas for improving the health sector:</p>
                    <p>Dear Honorable Minister of Health,</p>
                    <p>I am writing to you as a concerned citizen and a member of the Nigerian Medical Association (NMA). I have been working as a doctor in one of the public hospitals in Lagos for over five years, and I have witnessed firsthand the challenges and opportunities in our health sector.</p>
                    <p>I am writing to you to share my ideas on how we can improve our health infrastructure and provide better healthcare services to our people. I have chosen you as my recipient because I believe that you have the authority and the vision to make positive changes in our health sector.</p>
                    <p>My purpose for writing this letter is to suggest that we invest more in upgrading our existing health facilities and equipment, as well as building new ones where they are needed most. I also suggest that we increase our budget allocation for health workers' salaries, training, and incentives, as well as for essential drugs and supplies.</p>
                    <p>My main idea is based on the following facts and evidence:</p>
                    <ul>
                        <li>According to the World Health Organization (WHO), Nigeria has one of the lowest ratios of doctors to population in Africa, with only 0.4 doctors per 1,000 people. This means that many Nigerians do not have access to adequate healthcare services, especially in rural areas.</li>
                        <li>According to the National Bureau of Statistics (NBS), Nigeria spent only 3.9% of its GDP on health in 2019, which is far below the 15% target set by the African Union (AU) in 2001. This means that our health sector is underfunded and understaffed, resulting in poor service delivery quality and efficiency.</li>
                        <li>According to the Nigeria Demographic and Health Survey (NDHS), Nigeria has one of the highest maternal mortality rates in the world, with 512 deaths per 100,000 live births in 2018. This means that many women die during pregnancy or childbirth due to preventable causes such as hemorrhage, infection, or eclampsia.</li>
                    </ul>
                    <p>Therefore, I propose that we take the following actions to improve our health infrastructure and services:</p>
                    <ul>
                        <li>Upgrade our existing health facilities and equipment by renovating buildings, installing modern devices, expanding wards, improving sanitation, etc.</li>
                        <li>Build new health facilities and equipment where they are needed most by conducting a needs assessment, identifying priority areas, mobilizing resources, etc.</li>
                        <li>Increase our budget allocation for health workers' salaries, training, and incentives by reviewing pay scales, providing scholarships, offering bonuses, etc.</li>
                        <li>Increase our budget allocation for essential drugs and supplies by procuring quality medicines, ensuring adequate stock levels, preventing wastage, etc.</li>
                    </ul>
                    <p>I believe these actions will positively impact our health sector and our people's well-being. They will also help us achieve our national and international goals of universal health coverage (UHC), sustainable development goals (SDGs), and African health strategy (AHS).</p>
                    <p class="mb-3">I appreciate your consideration of my ideas and look forward to hearing from you soon. Please feel free to contact me at 08012345678 or doctor@example.com if you have any questions or require any further information. I would also be honored if you could arrange a meeting with me or invite me to present my ideas in person.</p>
                    <p class="mb-4">Thank you for your time and attention.</p>
                    <p class="mb-1">Sincerely,</p>
                    <p class="mb-0">Dr. John Doe</p>
                    <p>Member of NMA</p>
                    <p>We hope this helps you write your guide on preparing a letter with ideas to the government about building a new or improving existing infrastructure.</p>
                    <h5 class="mt-5"><strong>Example 2</strong></h5>
                    <ol>
                        <li>Identify yourself and your organization. In the first paragraph of your letter, you should introduce yourself and your organization and explain why you are interested and qualified to share your ideas with the government. You can also mention any relevant background or experience you have in the sector you are addressing.</li>
                        <li>Identify the government official or department you are writing to. In the second paragraph, you should state the name and title of the government official or the name of the department you are writing to and explain why you have chosen them as your recipient. You should also mention how you obtained their contact information.</li>
                        <li>State your purpose and main idea for the letter. In the third paragraph, you should clearly state your letter and your main idea or suggestion for building a new or improving existing infrastructure. You should also mention how your idea aligns with the government's goals and priorities for the sector.</li>
                        <li>Provide details and evidence to support your idea. In the next section, you should elaborate on your idea and provide specific details and evidence to show how it will benefit the public and address the current challenges or gaps in the infrastructure. You can use facts, figures, examples, testimonials, or other relevant information to support your idea. You can use bullet points or subheadings to organize this section.</li>
                        <li>Request a response or a meeting. In the last paragraph, you should thank the government official or department for their time and attention and request a response or a meeting to discuss your idea further. You should also express your willingness and availability to provide more information or clarification if needed. You should provide your contact details and sign off with a professional closing.</li>
                        <li>Format your letter. You should use a clear and professional font, such as Times New Roman or Arial, and a font size of 12 points. You should also use proper spacing, margins, headings, and alignment for your letter. You should follow the instructions and guidelines provided by the government for submitting your letter, such as the number of copies, packaging, email subject line, etc.</li>
                    </ol>
                    <p>Here is an example of a letter with ideas for improving the health sector:</p>
                    <p>Dear Honorable Minister of Health,</p>
                    <p>I am writing to you as a concerned citizen and a member of the Nigerian Medical Association (NMA). I have been working as a doctor in one of the public hospitals in Lagos for over five years, and I have witnessed firsthand the challenges and opportunities in our health sector.</p>
                    <p>I am writing to you to share my ideas on how we can improve our health infrastructure and provide better healthcare services to our people. I have chosen you as my recipient because I believe that you have the authority and the vision to make positive changes in our health sector.</p>
                    <p>My purpose for writing this letter is to suggest that we invest more in upgrading our existing health facilities and equipment, as well as building new ones where they are needed most. I also suggest that we increase our budget allocation for health workers' salaries, training, and incentives, as well as for essential drugs and supplies.</p>
                    <p>My main idea is based on the following facts and evidence:</p>
                    <ul>
                        <li>According to the World Health Organization (WHO), Nigeria has one of the lowest ratios of doctors to population in Africa, with only 0.4 doctors per 1,000 people. This means that many Nigerians do not have access to adequate healthcare services, especially in rural areas.</li>
                        <li>According to the National Bureau of Statistics (NBS), Nigeria spent only 3.9% of its GDP on health in 2019, which is far below the 15% target set by the African Union (AU) in 2001. This means that our health sector is underfunded and understaffed, resulting in poor service delivery quality and efficiency.</li>
                        <li>According to the Nigeria Demographic and Health Survey (NDHS), Nigeria has one of the highest maternal mortality rates in the world, with 512 deaths per 100,000 live births in 2018. This means that many women die during pregnancy or childbirth due to preventable causes such as hemorrhage, infection, or eclampsia.</li>
                    </ul>
                    <p>Therefore, I propose that we take the following actions to improve our health infrastructure and services:</p>
                    <ul>
                        <li>Upgrade our existing health facilities and equipment by renovating buildings, installing modern devices, expanding wards, improving sanitation, etc.</li>
                        <li>Build new health facilities and equipment where they are needed most by conducting a needs assessment, identifying priority areas, mobilizing resources, etc.</li>
                        <li>Increase our budget allocation for health workers' salaries, training, and incentives by reviewing pay scales, providing scholarships, offering bonuses, etc.</li>
                        <li>Increase our budget allocation for essential drugs and supplies by procuring quality medicines, ensuring adequate stock levels, preventing wastage, etc.</li>
                    </ul>
                    <p>I believe these actions will positively impact our health sector and our people's well-being. They will also help us achieve our national and international goals of universal health coverage (UHC), sustainable development goals (SDGs), and African health strategy (AHS).</p>
                    <p class="mb-3">I appreciate your consideration of my ideas and look forward to hearing from you soon. Please feel free to contact me at 08012345678 or doctor@example.com if you have any questions or require any further information. I would also be honored if you could arrange a meeting with me or invite me to present my ideas in person.</p>
                    <p class="mb-4">Thank you for your time and attention.</p>
                    <p class="mb-1">Sincerely,</p>
                    <p class="mb-0">Dr. John Doe</p>
                    <p>Member of NMA</p>
                    <p>We hope this helps you write your guide on preparing a letter with ideas to the government about building a new or improving existing infrastructure.</p>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-que" type="button" data-toggle="collapse" data-target="#question3" aria-expanded="false" aria-controls="question3">
                C - How do I protect my ideas?
                <i class="mdi mdi-chevron-down"></i>
                <i class="mdi mdi-chevron-up"></i>
            </button>

            <div class="collapse" id="question3">
                <div class="card card-body">
                    <p>In order to secure your ideas from unauthorized use or imitation, we suggest that you seek legal counsel about obtaining patent protection for your idea.</p>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-que" type="button" data-toggle="collapse" data-target="#question4" aria-expanded="false" aria-controls="question4">
                D - Any assurance that my proposal will be accepted?
                <i class="mdi mdi-chevron-down"></i>
                <i class="mdi mdi-chevron-up"></i>
            </button>

            <div class="collapse" id="question4">
                <div class="card card-body">
                   <p>The acceptance of your proposal will depend on the quality of your writing and the relevance of your idea to the government. Therefore, you should invest time crafting the proposal and back it up with data and evidence.</p>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-que" type="button" data-toggle="collapse" data-target="#question5" aria-expanded="false" aria-controls="question5">
                E - How do I know when my proposal has been reviewed?
                <i class="mdi mdi-chevron-down"></i>
                <i class="mdi mdi-chevron-up"></i>
            </button>

            <div class="collapse" id="question5">
                <div class="card card-body">
                    <p>The portal displays the number of views your proposal has received. Additionally, the agency evaluating your proposal can contact you via the phone or email you provided during your registration.</p>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-que" type="button" data-toggle="collapse" data-target="#question6" aria-expanded="false" aria-controls="question6">
                F - Can I update my proposal?
                <i class="mdi mdi-chevron-down"></i>
                <i class="mdi mdi-chevron-up"></i>
            </button>

            <div class="collapse" id="question6">
                <div class="card card-body">
                    <p>Yes, you can. Please sign in, go to your profile, and edit your proposal.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection