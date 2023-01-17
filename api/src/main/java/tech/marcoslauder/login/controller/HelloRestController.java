package tech.marcoslauder.login.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.access.prepost.PostAuthorize;
import org.springframework.security.oauth2.core.OAuth2AuthenticatedPrincipal;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import jakarta.annotation.security.RolesAllowed;

@RestController
@RequestMapping("hello")
public class HelloRestController {

    @GetMapping("user")
    @RolesAllowed("admin")
    @PostAuthorize("returnObject.username == authentication.principal.name")
    public String helloUser(String username, OAuth2AuthenticatedPrincipal principal) {
        System.out.println(principal);
        return "Hello " + username;
    }
}
