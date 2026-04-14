<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* security/login.html.twig */
class __TwigTemplate_d4bb18a913e3b777c33fb367c2272479 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Connexion</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
        body { background: linear-gradient(135deg, #667eea, #764ba2); min-height: 100vh; }
        .card { border-radius: 15px; }
    </style>
</head>
<body class=\"d-flex justify-content-center align-items-center\">
<div class=\"card p-4 shadow\" style=\"width: 420px;\">
    <h3 class=\"text-center mb-4\">🔐 Connexion</h3>

    ";
        // line 16
        if ((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 16, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 17
            yield "        <div class=\"alert alert-danger\">
            ";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 18, $this->source); })()), "messageKey", [], "any", false, false, false, 18), CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 18, $this->source); })()), "messageData", [], "any", false, false, false, 18), "security"), "html", null, true);
            yield "
        </div>
    ";
        }
        // line 21
        yield "
    ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 22, $this->source); })()), "flashes", ["success"], "method", false, false, false, 22));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 23
            yield "        <div class=\"alert alert-success\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        yield "
    <form method=\"post\" action=\"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\">
        <div class=\"mb-3\">
            <label class=\"form-label\">Email</label>
            <input type=\"email\" name=\"_username\" class=\"form-control\"
                   value=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 30, $this->source); })()), "html", null, true);
        yield "\" required autofocus>
        </div>

        <div class=\"mb-3\">
            <label class=\"form-label\">Mot de passe</label>
            <input type=\"password\" name=\"_password\" class=\"form-control\" required>
        </div>

        <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\">

        <button class=\"btn btn-primary w-100\">Se connecter</button>
    </form>

    <div class=\"text-center mt-3\">
        <small>Pas de compte ? <a href=\"";
        // line 44
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">S'inscrire</a></small>
    </div>
</div>
</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "security/login.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  122 => 44,  113 => 38,  102 => 30,  95 => 26,  92 => 25,  83 => 23,  79 => 22,  76 => 21,  70 => 18,  67 => 17,  65 => 16,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Connexion</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
        body { background: linear-gradient(135deg, #667eea, #764ba2); min-height: 100vh; }
        .card { border-radius: 15px; }
    </style>
</head>
<body class=\"d-flex justify-content-center align-items-center\">
<div class=\"card p-4 shadow\" style=\"width: 420px;\">
    <h3 class=\"text-center mb-4\">🔐 Connexion</h3>

    {% if error %}
        <div class=\"alert alert-danger\">
            {{ error.messageKey|trans(error.messageData, 'security') }}
        </div>
    {% endif %}

    {% for msg in app.flashes('success') %}
        <div class=\"alert alert-success\">{{ msg }}</div>
    {% endfor %}

    <form method=\"post\" action=\"{{ path('app_login') }}\">
        <div class=\"mb-3\">
            <label class=\"form-label\">Email</label>
            <input type=\"email\" name=\"_username\" class=\"form-control\"
                   value=\"{{ last_username }}\" required autofocus>
        </div>

        <div class=\"mb-3\">
            <label class=\"form-label\">Mot de passe</label>
            <input type=\"password\" name=\"_password\" class=\"form-control\" required>
        </div>

        <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\">

        <button class=\"btn btn-primary w-100\">Se connecter</button>
    </form>

    <div class=\"text-center mt-3\">
        <small>Pas de compte ? <a href=\"{{ path('app_register') }}\">S'inscrire</a></small>
    </div>
</div>
</body>
</html>", "security/login.html.twig", "/var/www/html/templates/security/login.html.twig");
    }
}
