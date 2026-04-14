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

/* security/register.html.twig */
class __TwigTemplate_2431cf52d5c444e4df6ec8a34fb3e345 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/register.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/register.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Inscription</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
        body { background: linear-gradient(135deg, #667eea, #764ba2); min-height: 100vh; }
        .card { border-radius: 15px; }
    </style>
</head>
<body class=\"d-flex justify-content-center align-items-center py-5\">
<div class=\"card p-4 shadow\" style=\"width: 480px;\">
    <h3 class=\"text-center mb-4\">📝 Inscription</h3>

    ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 16, $this->source); })()), "flashes", ["success"], "method", false, false, false, 16));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 17
            yield "        <div class=\"alert alert-success\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        yield "
    ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 20, $this->source); })()), "flashes", ["error"], "method", false, false, false, 20));
        foreach ($context['_seq'] as $context["_key"] => $context["msg"]) {
            // line 21
            yield "        <div class=\"alert alert-danger\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["msg"], "html", null, true);
            yield "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['msg'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        yield "
    ";
        // line 24
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 24, $this->source); })()), 'form_start', ["action" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register"), "method" => "POST", "attr" => ["novalidate" => "novalidate"]]);
        yield "
        <div class=\"mb-3\">
            ";
        // line 26
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 26, $this->source); })()), "firstName", [], "any", false, false, false, 26), 'label', ["label_attr" => ["class" => "form-label"], "label" => "Prénom"]);
        yield "
            ";
        // line 27
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 27, $this->source); })()), "firstName", [], "any", false, false, false, 27), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
            ";
        // line 28
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), "firstName", [], "any", false, false, false, 28), 'errors');
        yield "
        </div>
        <div class=\"mb-3\">
            ";
        // line 31
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 31, $this->source); })()), "lastName", [], "any", false, false, false, 31), 'label', ["label_attr" => ["class" => "form-label"], "label" => "Nom"]);
        yield "
            ";
        // line 32
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 32, $this->source); })()), "lastName", [], "any", false, false, false, 32), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
            ";
        // line 33
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 33, $this->source); })()), "lastName", [], "any", false, false, false, 33), 'errors');
        yield "
        </div>
        <div class=\"mb-3\">
            ";
        // line 36
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 36, $this->source); })()), "email", [], "any", false, false, false, 36), 'label', ["label_attr" => ["class" => "form-label"], "label" => "Email"]);
        yield "
            ";
        // line 37
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 37, $this->source); })()), "email", [], "any", false, false, false, 37), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
            ";
        // line 38
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "email", [], "any", false, false, false, 38), 'errors');
        yield "
        </div>
        <div class=\"mb-3\">
            ";
        // line 41
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 41, $this->source); })()), "password", [], "any", false, false, false, 41), "first", [], "any", false, false, false, 41), 'label', ["label_attr" => ["class" => "form-label"], "label" => "Mot de passe"]);
        yield "
            ";
        // line 42
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 42, $this->source); })()), "password", [], "any", false, false, false, 42), "first", [], "any", false, false, false, 42), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
            ";
        // line 43
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 43, $this->source); })()), "password", [], "any", false, false, false, 43), "first", [], "any", false, false, false, 43), 'errors');
        yield "
        </div>
        <div class=\"mb-3\">
            ";
        // line 46
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 46, $this->source); })()), "password", [], "any", false, false, false, 46), "second", [], "any", false, false, false, 46), 'label', ["label_attr" => ["class" => "form-label"], "label" => "Confirmer"]);
        yield "
            ";
        // line 47
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 47, $this->source); })()), "password", [], "any", false, false, false, 47), "second", [], "any", false, false, false, 47), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
            ";
        // line 48
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 48, $this->source); })()), "password", [], "any", false, false, false, 48), "second", [], "any", false, false, false, 48), 'errors');
        yield "
        </div>

        <button type=\"submit\" class=\"btn btn-success w-100\">Créer mon compte</button>
    ";
        // line 52
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), 'form_end');
        yield "

    <div class=\"text-center mt-3\">
        <small>Déjà un compte ? <a href=\"";
        // line 55
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\">Se connecter</a></small>
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
        return "security/register.html.twig";
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
        return array (  179 => 55,  173 => 52,  166 => 48,  162 => 47,  158 => 46,  152 => 43,  148 => 42,  144 => 41,  138 => 38,  134 => 37,  130 => 36,  124 => 33,  120 => 32,  116 => 31,  110 => 28,  106 => 27,  102 => 26,  97 => 24,  94 => 23,  85 => 21,  81 => 20,  78 => 19,  69 => 17,  65 => 16,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Inscription</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
        body { background: linear-gradient(135deg, #667eea, #764ba2); min-height: 100vh; }
        .card { border-radius: 15px; }
    </style>
</head>
<body class=\"d-flex justify-content-center align-items-center py-5\">
<div class=\"card p-4 shadow\" style=\"width: 480px;\">
    <h3 class=\"text-center mb-4\">📝 Inscription</h3>

    {% for msg in app.flashes('success') %}
        <div class=\"alert alert-success\">{{ msg }}</div>
    {% endfor %}

    {% for msg in app.flashes('error') %}
        <div class=\"alert alert-danger\">{{ msg }}</div>
    {% endfor %}

    {{ form_start(form, {'action': path('app_register'), 'method': 'POST', 'attr': {'novalidate': 'novalidate'}}) }}
        <div class=\"mb-3\">
            {{ form_label(form.firstName, 'Prénom', {'label_attr': {'class': 'form-label'}}) }}
            {{ form_widget(form.firstName, {'attr': {'class': 'form-control'}}) }}
            {{ form_errors(form.firstName) }}
        </div>
        <div class=\"mb-3\">
            {{ form_label(form.lastName, 'Nom', {'label_attr': {'class': 'form-label'}}) }}
            {{ form_widget(form.lastName, {'attr': {'class': 'form-control'}}) }}
            {{ form_errors(form.lastName) }}
        </div>
        <div class=\"mb-3\">
            {{ form_label(form.email, 'Email', {'label_attr': {'class': 'form-label'}}) }}
            {{ form_widget(form.email, {'attr': {'class': 'form-control'}}) }}
            {{ form_errors(form.email) }}
        </div>
        <div class=\"mb-3\">
            {{ form_label(form.password.first, 'Mot de passe', {'label_attr': {'class': 'form-label'}}) }}
            {{ form_widget(form.password.first, {'attr': {'class': 'form-control'}}) }}
            {{ form_errors(form.password.first) }}
        </div>
        <div class=\"mb-3\">
            {{ form_label(form.password.second, 'Confirmer', {'label_attr': {'class': 'form-label'}}) }}
            {{ form_widget(form.password.second, {'attr': {'class': 'form-control'}}) }}
            {{ form_errors(form.password.second) }}
        </div>

        <button type=\"submit\" class=\"btn btn-success w-100\">Créer mon compte</button>
    {{ form_end(form) }}

    <div class=\"text-center mt-3\">
        <small>Déjà un compte ? <a href=\"{{ path('app_login') }}\">Se connecter</a></small>
    </div>
</div>
</body>
</html>", "security/register.html.twig", "/var/www/html/templates/security/register.html.twig");
    }
}
