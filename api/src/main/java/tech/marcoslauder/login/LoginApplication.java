package tech.marcoslauder.login;

import org.springframework.beans.factory.annotation.Value;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.Bean;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configurers.oauth2.server.resource.OAuth2ResourceServerConfigurer;
import org.springframework.security.oauth2.core.OAuth2TokenValidator;
import org.springframework.security.oauth2.core.OAuth2TokenValidatorResult;
import org.springframework.security.oauth2.jwt.Jwt;
import org.springframework.security.oauth2.jwt.JwtDecoder;
import org.springframework.security.oauth2.jwt.NimbusJwtDecoder;
import org.springframework.security.web.SecurityFilterChain;

@SpringBootApplication
public class LoginApplication {

	@Value("${spring.security.oauth2.resourceserver.jwt.issuer-uri}")
    private String issuerUri;

	public static void main(String[] args) {
		SpringApplication.run(LoginApplication.class, args);
		System.out.println("SISTEMA ONLINE");
	}

	@Bean
	public SecurityFilterChain filterChain(HttpSecurity http) throws Exception {
		// http.authorizeHttpRequests(authorize -> authorize
		// 	.anyRequest().authenticated())
		// 	.oauth2ResourceServer(OAuth2ResourceServerConfigurer::jwt);

		http.authorizeHttpRequests()
			.anyRequest()
			.authenticated()
			.and()
			.oauth2ResourceServer()
			.jwt();

		return http.build();
	}

	@Bean
    public JwtDecoder jwtDecoder() {
        // Usando a URL do issuer que foi injetada no campo issuerUri
        NimbusJwtDecoder jwtDecoder = NimbusJwtDecoder.withJwkSetUri(issuerUri + "/protocol/openid-connect/certs")
                .build();

        // Criar um validador customizado que ignora a validação do issuer
        OAuth2TokenValidator<Jwt> issuerValidator = jwt -> OAuth2TokenValidatorResult.success(); // Aceita todos os tokens sem validação

        // Adicionar o validador customizado
        jwtDecoder.setJwtValidator(issuerValidator);

        return jwtDecoder;
    }
}
