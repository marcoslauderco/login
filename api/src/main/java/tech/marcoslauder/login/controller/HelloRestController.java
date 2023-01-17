package tech.marcoslauder.login.controller;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.oauth2.jwt.Jwt;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

import tech.marcoslauder.login.model.User;

@RestController
public class HelloRestController {

    @GetMapping("user")
    // @RolesAllowed("admin")
    public ResponseEntity<User> helloUser() {
        Authentication authentication = SecurityContextHolder.getContext().getAuthentication();
        Jwt jwt = (Jwt) authentication.getPrincipal();
        User user = User.createFromJwt(jwt);
        return new ResponseEntity<User>(user, HttpStatus.OK);
    }
}
