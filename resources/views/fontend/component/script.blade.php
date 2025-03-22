<script src="{{ asset('public/fontend/vendors/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('public/fontend/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/fontend/vendors/skrollr.min.js') }}"></script>
<script src="{{ asset('public/fontend/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/fontend/vendors/nice-select/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('public/fontend/vendors/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('public/fontend/vendors/mail-script.js') }}"></script>
<script src="{{ asset('public/fontend/js/main.js') }}"></script>
{{-- Chat Bot --}}
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<style>
    df-messenger {
      --df-messenger-bot-message: #f0f0f0;
      --df-messenger-user-message: #007bff;
      --df-messenger-user-message-font-color: white;
      --df-messenger-button-titlebar-color: #007bff;
      --df-messenger-button-titlebar-font-color: white;
      --df-messenger-chat-background-color: white;
      --df-messenger-font-color: black;
      --df-messenger-send-icon: #007bff;
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
      width: 350px;
      max-height: 80vh;
    }
  </style>
  
  <df-messenger
  intent="Xin chào"
  chat-title="Dịch vụ tư vấn"
  agent-id="63a70a68-bcf4-482d-b60f-8b1eecb28db9"
  language-code="vi">
</df-messenger>