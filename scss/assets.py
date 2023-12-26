from flask_assets import Bundle, Environment, Filter

class ConcatFilter(Filter):
    """
    Filter that merges files, placing a semicolon between them.

    Fixes issues caused by missing semicolons at end of JS assets, for example
    with last statement of jquery.pjax.js.
    """
    def concat(self, out, hunks, **kw):
        out.write(';'.join([h.data() for h, info in hunks]))

js = Bundle(
    'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js',
    'js/application.js',
    filters=(ConcatFilter, 'jsmin'),
    output='gen/packed.js'
)

css = Bundle(
    'css/reset.css',
    'css/header.css',
    'css/splash.css',
    'css/footer.css',
    'css/forms.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css',
    'css/style.css',
    filters=('cssmin','cssrewrite'),
    output='gen/packed.css'
)

assets = Environment()
assets.register('js_all', js)
assets.register('css_all', css)
