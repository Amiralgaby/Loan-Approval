package gabriel.AccountManager.controllers;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("")
public class HomeController {

    @GetMapping("")
    public String homeMapping(){
        return "<!DOCTYPE html>\n" +
                "<html>\n" +
                "<head>\n" +
                "\t<meta charset=\"utf-8\">\n" +
                "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n" +
                "\t<title>Loan-Approval HOME</title>\n" +
                "</head>\n" +
                "<body>\n" +
                "\t<h1>Bienvenue sur le home de Loan-Approval</h1>\n" +
                "\t<p>Quelques liens : </p>\n" +
                "\t<ul>\n" +
                "\t\t<li><a href=\"https://github.com/Amiralgaby/Loan-Approval\">Github du projet (voir le dossier account manager)</a></li>\n" +
                "\t\t<li><a href=\"https://resolute-planet-344619.oa.r.appspot.com/acc\">lien vers le point d'entrée de l'account manager (sur GAE)</a></li>\n" +
                "\t</ul>\n" +
                "\n" +
                "\t<h2>Le service <strong>Account Manager</strong></h2>\n" +
                "\t\t<p>Vous êtes actuellement sur la page HOME de ce service</p>\n" +
                "\t\t<ul>\n" +
                "\t\t\t<li>Pour GET all compte : <a href=\"./acc\">GET /acc</a></li>\n" +
                "\t\t\t<li>Pour GET un compte précis (sur GAE) : <a href=\" https://resolute-planet-344619.oa.r.appspot.com/acc/id_du_compte\">https://resolute-planet-344619.oa.r.appspot.com/acc/<strong>{id_du_compte}</strong></a></li>\n" +
                "\t\t\t<li>Pour DELETE et POST c'est la même URL que GET un compte précis sauf que le verbe de votre requête doit être changé</li>\n" +
                "\t\t</ul>\n" +
                "\t\t<div style=\"margin-left: 10%;\">\n" +
                "\t\t\t<h3>GET dynamic link</h3>\n" +
                "\t\t\t<input placeholder=\"id\" type=\"text\" id=\"inputId\"/>\n" +
                "\t\t\t<p><a id=\"linkGet\" href=\"./acc/id\">https://resolute-planet-344619.oa.r.appspot.com/acc/id</a></p>\n" +
                "\t\t</div>\n" +
                "\t\t<p>prévoir post et delete sur cette page</p>\n" +
                "\n" +
                "\t<h2>Le service<strong>Approval Manager</strong></h2>\n" +
                "\t\t<p><a href=\"https://github.com/Amiralgaby/Loan-Approval/issues/1\">API - service - AppManager - gérer les approval</a> (issue n°1 Github)</p>\n" +
                "\n" +
                "\t<h2>Le service <strong>Loan Approval</strong></h2>\n" +
                "\t\t<p><a href=\"https://github.com/Amiralgaby/Loan-Approval/issues/2\">l'issue n°2 sur Github</a></p>\n" +
                "\t<script>\n" +
                "\tconst element = document.getElementById(\"inputId\");\n" +
                "\tlet linkGet = document.getElementById(\"linkGet\");\n" +
                "\telement.addEventListener('input', function(){\n" +
                "\t\tlinkGet.href = linkGet.innerHTML = window.location.origin + \"/acc/\" + this.value;\n" +
                "\t});\n" +
                "\t</script>\n" +
                "</body>\n" +
                "</html>";
    }

}
