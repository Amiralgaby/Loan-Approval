package gabriel.AccountManager.controllers;

import gabriel.AccountManager.model.BankAccount;
import gabriel.AccountManager.model.Risk;
import gabriel.AccountManager.services.AccService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.Optional;

@RestController
@RequestMapping("/check")
public class CheckAccountRisk {

    @Autowired
    private AccService service;

    @GetMapping("{id}")
    public ResponseEntity<Risk> getRiskOfAccount(@PathVariable("id") String id){
        try{
            if (id == null)
                return new ResponseEntity<>(HttpStatus.UNPROCESSABLE_ENTITY);

            Long parseLong = Long.parseLong(id);

            Optional<BankAccount> optionalBankAccount = service.getById(parseLong);

            if (optionalBankAccount.isEmpty()){
                return new ResponseEntity<>(HttpStatus.NOT_FOUND);
            }

            return new ResponseEntity<>(optionalBankAccount.get().getRisk(),HttpStatus.OK);

        }catch (NumberFormatException numberFormatException){
            return new ResponseEntity<>(HttpStatus.UNPROCESSABLE_ENTITY);
        }
    }
}
