package tech.marcoslauder.login.model;

import java.io.Serializable;

import org.springframework.security.oauth2.jwt.Jwt;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
@AllArgsConstructor
@Data
public class User implements Serializable {

    private String id;
    private String nome;
    private String email;

    public static User createFromJwt(Jwt jwt) {
        return new User(jwt.getClaimAsString("sid"), 
                        jwt.getClaimAsString("name"),
                        jwt.getClaimAsString("email"));
    }

}
