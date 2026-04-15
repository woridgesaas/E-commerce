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

/* security/emails/reset_password.html.twig */
class __TwigTemplate_4439894771bbf0bbc445ac00c4653bce extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/emails/reset_password.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/emails/reset_password.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html>
<body style=\"font-family: Arial; background:#f4f6f8; padding:30px;\">

<div style=\"max-width:500px; margin:auto; background:white; padding:25px; border-radius:10px; text-align:center;\">

    <h2 style=\"color:#4f46e5;\">🔐 Woridge</h2>

    <h3>Password Reset</h3>

    <p style=\"color:#555;\">
        Hello ";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 12, $this->source); })()), "firstName", [], "any", false, false, false, 12), "value", [], "any", false, false, false, 12), "html", null, true);
        yield ",<br><br>
        We received a request to reset your password.
    </p>

    <a href=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new RuntimeError('Variable "link" does not exist.', 16, $this->source); })()), "html", null, true);
        yield "\"
       style=\"display:inline-block; padding:12px 20px; margin:20px 0;
              background:#4f46e5; color:white; text-decoration:none;
              border-radius:6px; font-weight:bold;\">
        Reset Password
    </a>

    <p style=\"font-size:13px; color:#888;\">
        This link expires in 1 hour.
    </p>

    <hr style=\"margin:20px 0;\">

    <p style=\"font-size:12px; color:#aaa;\">
        If you didn’t request this, you can safely ignore this email.
    </p>

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
        return "security/emails/reset_password.html.twig";
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
        return array (  68 => 16,  61 => 12,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<body style=\"font-family: Arial; background:#f4f6f8; padding:30px;\">

<div style=\"max-width:500px; margin:auto; background:white; padding:25px; border-radius:10px; text-align:center;\">

    <h2 style=\"color:#4f46e5;\">🔐 Woridge</h2>

    <h3>Password Reset</h3>

    <p style=\"color:#555;\">
        Hello {{ user.firstName.value }},<br><br>
        We received a request to reset your password.
    </p>

    <a href=\"{{ link }}\"
       style=\"display:inline-block; padding:12px 20px; margin:20px 0;
              background:#4f46e5; color:white; text-decoration:none;
              border-radius:6px; font-weight:bold;\">
        Reset Password
    </a>

    <p style=\"font-size:13px; color:#888;\">
        This link expires in 1 hour.
    </p>

    <hr style=\"margin:20px 0;\">

    <p style=\"font-size:12px; color:#aaa;\">
        If you didn’t request this, you can safely ignore this email.
    </p>

</div>

</body>
</html>", "security/emails/reset_password.html.twig", "/var/www/html/templates/security/emails/reset_password.html.twig");
    }
}
