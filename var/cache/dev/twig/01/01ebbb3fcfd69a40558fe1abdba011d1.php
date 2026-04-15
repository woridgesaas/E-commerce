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

/* partials/footer.html.twig */
class __TwigTemplate_1aac907dcf33f7b4285d00f75628b56e extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partials/footer.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partials/footer.html.twig"));

        // line 1
        yield "<footer class=\"bg-dark text-white mt-5 pt-4 pb-3\">
  <div class=\"container\">

    <div class=\"row\">

      <!-- Logo / Description -->
      <div class=\"col-md-4\">
        <h5 class=\"fw-bold\">🔷 Woridge</h5>
        <p class=\"text-muted small\">
          Plateforme SaaS moderne pour gérer vos utilisateurs et services efficacement.
        </p>
      </div>

      <!-- Links -->
      <div class=\"col-md-4\">
        <h6 class=\"fw-bold\">Navigation</h6>
        <ul class=\"list-unstyled small\">
          <li><a href=\"#\" class=\"text-muted text-decoration-none\">À propos</a></li>
          <li><a href=\"#\" class=\"text-muted text-decoration-none\">Notre produit</a></li>
          <li><a href=\"#\" class=\"text-muted text-decoration-none\">Contact</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class=\"col-md-4\">
        <h6 class=\"fw-bold\">Contact</h6>
        <p class=\"small text-muted\">
           support@woridge.com <br>
         Maroc
        </p>
      </div>

    </div>

    <hr class=\"border-secondary\">

    <div class=\"text-center small text-muted\">
      © ";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " Woridge. Tous droits réservés.
    </div>

  </div>
</footer>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/footer.html.twig";
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
        return array (  87 => 38,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<footer class=\"bg-dark text-white mt-5 pt-4 pb-3\">
  <div class=\"container\">

    <div class=\"row\">

      <!-- Logo / Description -->
      <div class=\"col-md-4\">
        <h5 class=\"fw-bold\">🔷 Woridge</h5>
        <p class=\"text-muted small\">
          Plateforme SaaS moderne pour gérer vos utilisateurs et services efficacement.
        </p>
      </div>

      <!-- Links -->
      <div class=\"col-md-4\">
        <h6 class=\"fw-bold\">Navigation</h6>
        <ul class=\"list-unstyled small\">
          <li><a href=\"#\" class=\"text-muted text-decoration-none\">À propos</a></li>
          <li><a href=\"#\" class=\"text-muted text-decoration-none\">Notre produit</a></li>
          <li><a href=\"#\" class=\"text-muted text-decoration-none\">Contact</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class=\"col-md-4\">
        <h6 class=\"fw-bold\">Contact</h6>
        <p class=\"small text-muted\">
           support@woridge.com <br>
         Maroc
        </p>
      </div>

    </div>

    <hr class=\"border-secondary\">

    <div class=\"text-center small text-muted\">
      © {{ \"now\"|date(\"Y\") }} Woridge. Tous droits réservés.
    </div>

  </div>
</footer>", "partials/footer.html.twig", "/home/safae/ecommerce/templates/partials/footer.html.twig");
    }
}
