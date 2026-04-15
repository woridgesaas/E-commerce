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

/* partials/header.html.twig */
class __TwigTemplate_b0f9e4f086e5ba28848e479fcc51ff86 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partials/header.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partials/header.html.twig"));

        // line 1
        yield "<nav class=\"navbar navbar-expand-lg navbar-light bg-white shadow-sm\">
  <div class=\"container\">

    <!-- Logo -->
    <a class=\"navbar-brand fw-bold text-primary\" href=\"";
        // line 5
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\">
      <span style=\"font-size: 20px;\">🔷 Woridge</span>
    </a>

    <!-- Toggle mobile -->
    <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>

    <!-- Menu -->
    <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbarNav\">
      <ul class=\"navbar-nav align-items-center gap-3\">

        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"#\">À propos</a>
        </li>

        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"#\">Notre produit</a>
        </li>

        ";
        // line 26
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 26, $this->source); })()), "user", [], "any", false, false, false, 26)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 27
            yield "          <!-- User connecté -->
          <li class=\"nav-item\">
            <a class=\"btn btn-primary px-3\" href=\"";
            // line 29
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard");
            yield "\">
              Dashboard
            </a>
          </li>

          <li class=\"nav-item\">
            <a class=\"btn btn-outline-danger px-3\" href=\"";
            // line 35
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\">
              Logout
            </a>
          </li>

        ";
        } else {
            // line 41
            yield "          <!-- Guest -->
          <li class=\"nav-item\">
            <a class=\"btn btn-outline-primary px-3\" href=\"";
            // line 43
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\">
              Se connecter
            </a>
          </li>

          <li class=\"nav-item\">
            <a class=\"btn btn-primary px-3\" href=\"";
            // line 49
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\">
              S'inscrire
            </a>
          </li>
        ";
        }
        // line 54
        yield "
      </ul>
    </div>

  </div>
</nav>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "partials/header.html.twig";
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
        return array (  123 => 54,  115 => 49,  106 => 43,  102 => 41,  93 => 35,  84 => 29,  80 => 27,  78 => 26,  54 => 5,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<nav class=\"navbar navbar-expand-lg navbar-light bg-white shadow-sm\">
  <div class=\"container\">

    <!-- Logo -->
    <a class=\"navbar-brand fw-bold text-primary\" href=\"{{ path('app_login') }}\">
      <span style=\"font-size: 20px;\">🔷 Woridge</span>
    </a>

    <!-- Toggle mobile -->
    <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>

    <!-- Menu -->
    <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbarNav\">
      <ul class=\"navbar-nav align-items-center gap-3\">

        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"#\">À propos</a>
        </li>

        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"#\">Notre produit</a>
        </li>

        {% if app.user %}
          <!-- User connecté -->
          <li class=\"nav-item\">
            <a class=\"btn btn-primary px-3\" href=\"{{ path('app_dashboard') }}\">
              Dashboard
            </a>
          </li>

          <li class=\"nav-item\">
            <a class=\"btn btn-outline-danger px-3\" href=\"{{ path('app_logout') }}\">
              Logout
            </a>
          </li>

        {% else %}
          <!-- Guest -->
          <li class=\"nav-item\">
            <a class=\"btn btn-outline-primary px-3\" href=\"{{ path('app_login') }}\">
              Se connecter
            </a>
          </li>

          <li class=\"nav-item\">
            <a class=\"btn btn-primary px-3\" href=\"{{ path('app_register') }}\">
              S'inscrire
            </a>
          </li>
        {% endif %}

      </ul>
    </div>

  </div>
</nav>", "partials/header.html.twig", "/home/safae/ecommerce/templates/partials/header.html.twig");
    }
}
