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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
            'scripts' => [$this, 'block_scripts'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base_auth.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/register.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/register.html.twig"));

        $this->parent = $this->load("base_auth.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Inscription";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 6
        yield "<h3 class=\"auth-title\">Inscription</h3>

";
        // line 8
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 8, $this->source); })()), 'form_start');
        yield "

<div class=\"mb-3 input-group position-relative\">
    <i class=\"bi bi-person\"></i>
    ";
        // line 12
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 12, $this->source); })()), "firstName", [], "any", false, false, false, 12), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
</div>

<div class=\"mb-3 input-group position-relative\">
    <i class=\"bi bi-person\"></i>
    ";
        // line 17
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 17, $this->source); })()), "lastName", [], "any", false, false, false, 17), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
</div>

<div class=\"mb-3 input-group position-relative\">
    <i class=\"bi bi-envelope\"></i>
    ";
        // line 22
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 22, $this->source); })()), "email", [], "any", false, false, false, 22), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
</div>

<div class=\"mb-2 input-group position-relative\">
    <i class=\"bi bi-lock\"></i>

    <div class=\"password-wrapper\">
        ";
        // line 29
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 29, $this->source); })()), "password", [], "any", false, false, false, 29), "first", [], "any", false, false, false, 29), 'widget', ["attr" => ["class" => "form-control"]]);
        // line 31
        yield "

        <span class=\"toggle-password\">👁</span>
    </div>
</div>
<div class=\"strength-meter mb-1\">
    <div id=\"strength-bar\"></div>
</div>
<small id=\"strength-text\" class=\"d-block mb-3\"></small>
<div class=\"mb-2 input-group position-relative\">
    <i class=\"bi bi-lock\"></i>

    <div class=\"password-wrapper\">
        ";
        // line 44
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 44, $this->source); })()), "password", [], "any", false, false, false, 44), "second", [], "any", false, false, false, 44), 'widget', ["attr" => ["class" => "form-control"]]);
        // line 46
        yield "

        <span class=\"toggle-password\">👁</span>
    </div>
</div>

<small id=\"match-error\" class=\"text-danger d-none d-block mb-2\">
    Les mots de passe ne correspondent pas
</small>

<div class=\"text-danger small mb-2\">
    ";
        // line 57
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 57, $this->source); })()), "password", [], "any", false, false, false, 57), 'errors');
        yield "
</div>

<button type=\"submit\" class=\"auth-btn mt-2\">Créer</button>

";
        // line 62
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 62, $this->source); })()), 'form_end');
        yield "

<div class=\"text-center mt-3\">
    <a href=\"";
        // line 65
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" class=\"auth-link\">Se connecter</a>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 68
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_scripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "scripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "scripts"));

        // line 69
        yield "<script>
document.addEventListener('DOMContentLoaded', function () {

    const password = document.querySelector('input[name=\"register[password][first]\"]');
    const confirmPassword = document.querySelector('input[name=\"register[password][second]\"]');

    const bar = document.getElementById(\"strength-bar\");
    const text = document.getElementById(\"strength-text\");
    const matchError = document.getElementById(\"match-error\");

    // ===== PASSWORD STRENGTH =====
    if (password && bar && text) {
    password.addEventListener(\"input\", () => {
        let strength = 0;
        const val = password.value;

        if (val.length >= 8) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[a-z]/.test(val)) strength++;
        if (/[0-9]/.test(val)) strength++;
        if (/[\\W]/.test(val)) strength++;

        const percent = (strength / 5) * 100;
        bar.style.width = percent + \"%\";

        if (strength <= 2) {
            bar.style.background = \"red\";
            text.textContent = \"Faible\";
            text.style.color = \"red\";
        } else if (strength <= 4) {
            bar.style.background = \"orange\";
            text.textContent = \"Moyen\";
            text.style.color = \"orange\";
        } else {
            bar.style.background = \"green\";
            text.textContent = \"Fort\";
            text.style.color = \"limegreen\";
        }
    });
}

    // ===== MATCH PASSWORD =====
    if (confirmPassword && password && matchError) {
        confirmPassword.addEventListener(\"input\", () => {
            if (confirmPassword.value !== password.value) {
                matchError.classList.remove(\"d-none\");
            } else {
                matchError.classList.add(\"d-none\");
            }
        });
    }

    // ===== SHOW / HIDE PASSWORD =====
    document.querySelectorAll('.password-wrapper').forEach(wrapper => {
        const input = wrapper.querySelector('input');
        const toggle = wrapper.querySelector('.toggle-password');

        toggle.addEventListener('click', () => {
            if (input.type === 'password') {
                input.type = 'text';
                toggle.textContent = '👁';
            } else {
                input.type = 'password';
                toggle.textContent = '👁';
            }
        });
    });

});
</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

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
        return array (  211 => 69,  198 => 68,  184 => 65,  178 => 62,  170 => 57,  157 => 46,  155 => 44,  140 => 31,  138 => 29,  128 => 22,  120 => 17,  112 => 12,  105 => 8,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base_auth.html.twig' %}

{% block title %}Inscription{% endblock %}

{% block content %}
<h3 class=\"auth-title\">Inscription</h3>

{{ form_start(form) }}

<div class=\"mb-3 input-group position-relative\">
    <i class=\"bi bi-person\"></i>
    {{ form_widget(form.firstName, {'attr': {'class': 'form-control'}}) }}
</div>

<div class=\"mb-3 input-group position-relative\">
    <i class=\"bi bi-person\"></i>
    {{ form_widget(form.lastName, {'attr': {'class': 'form-control'}}) }}
</div>

<div class=\"mb-3 input-group position-relative\">
    <i class=\"bi bi-envelope\"></i>
    {{ form_widget(form.email, {'attr': {'class': 'form-control'}}) }}
</div>

<div class=\"mb-2 input-group position-relative\">
    <i class=\"bi bi-lock\"></i>

    <div class=\"password-wrapper\">
        {{ form_widget(form.password.first, {
            'attr': {'class': 'form-control'}
        }) }}

        <span class=\"toggle-password\">👁</span>
    </div>
</div>
<div class=\"strength-meter mb-1\">
    <div id=\"strength-bar\"></div>
</div>
<small id=\"strength-text\" class=\"d-block mb-3\"></small>
<div class=\"mb-2 input-group position-relative\">
    <i class=\"bi bi-lock\"></i>

    <div class=\"password-wrapper\">
        {{ form_widget(form.password.second, {
            'attr': {'class': 'form-control'}
        }) }}

        <span class=\"toggle-password\">👁</span>
    </div>
</div>

<small id=\"match-error\" class=\"text-danger d-none d-block mb-2\">
    Les mots de passe ne correspondent pas
</small>

<div class=\"text-danger small mb-2\">
    {{ form_errors(form.password) }}
</div>

<button type=\"submit\" class=\"auth-btn mt-2\">Créer</button>

{{ form_end(form) }}

<div class=\"text-center mt-3\">
    <a href=\"{{ path('app_login') }}\" class=\"auth-link\">Se connecter</a>
</div>
{% endblock %}
{% block scripts %}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const password = document.querySelector('input[name=\"register[password][first]\"]');
    const confirmPassword = document.querySelector('input[name=\"register[password][second]\"]');

    const bar = document.getElementById(\"strength-bar\");
    const text = document.getElementById(\"strength-text\");
    const matchError = document.getElementById(\"match-error\");

    // ===== PASSWORD STRENGTH =====
    if (password && bar && text) {
    password.addEventListener(\"input\", () => {
        let strength = 0;
        const val = password.value;

        if (val.length >= 8) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[a-z]/.test(val)) strength++;
        if (/[0-9]/.test(val)) strength++;
        if (/[\\W]/.test(val)) strength++;

        const percent = (strength / 5) * 100;
        bar.style.width = percent + \"%\";

        if (strength <= 2) {
            bar.style.background = \"red\";
            text.textContent = \"Faible\";
            text.style.color = \"red\";
        } else if (strength <= 4) {
            bar.style.background = \"orange\";
            text.textContent = \"Moyen\";
            text.style.color = \"orange\";
        } else {
            bar.style.background = \"green\";
            text.textContent = \"Fort\";
            text.style.color = \"limegreen\";
        }
    });
}

    // ===== MATCH PASSWORD =====
    if (confirmPassword && password && matchError) {
        confirmPassword.addEventListener(\"input\", () => {
            if (confirmPassword.value !== password.value) {
                matchError.classList.remove(\"d-none\");
            } else {
                matchError.classList.add(\"d-none\");
            }
        });
    }

    // ===== SHOW / HIDE PASSWORD =====
    document.querySelectorAll('.password-wrapper').forEach(wrapper => {
        const input = wrapper.querySelector('input');
        const toggle = wrapper.querySelector('.toggle-password');

        toggle.addEventListener('click', () => {
            if (input.type === 'password') {
                input.type = 'text';
                toggle.textContent = '👁';
            } else {
                input.type = 'password';
                toggle.textContent = '👁';
            }
        });
    });

});
</script>
{% endblock %}", "security/register.html.twig", "/var/www/html/templates/security/register.html.twig");
    }
}
