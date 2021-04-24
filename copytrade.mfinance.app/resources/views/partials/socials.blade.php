<div class="row">
    <div class="col-md-12 margin-bottom-2 text-center">
    	{!! HTML::icon_link(route('social.redirect',['provider' => 'google']), 'fa fa-google', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-google')) !!}
    	{!! HTML::icon_link(route('social.redirect',['provider' => 'twitter']), 'fa fa-twitter', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-twitter')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'linkedin']), 'fa fa-linkedin', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-linkedin')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'github']), 'fa fa-github', '', array('class' => 'btn btn-social-icon btn-lg margin-half btn-github')) !!}
    </div>
</div>