package gabriel.AccountManager.controllers;

import gabriel.AccountManager.model.BankAccount;
import gabriel.AccountManager.services.AccService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@RequestMapping("/acc/add")
public class AddAccountController {

    @Autowired
    private AccService service;

    @PutMapping("/{id}")
    public ResponseEntity<BankAccount> addAccount(@PathVariable("id") String id,@RequestParam Double accountToAdd) {
        try {

            if (id == null || accountToAdd == null)
                return new ResponseEntity<>(HttpStatus.UNPROCESSABLE_ENTITY);

            Optional<BankAccount> optionalBankAccount = service.getById(Long.parseLong(id));

            if (optionalBankAccount.isEmpty()){
                return new ResponseEntity<>(HttpStatus.NOT_FOUND);
            }

            BankAccount myBankAccount = optionalBankAccount.get();
            myBankAccount.addAccount(accountToAdd);
            service.saveBankAccount(myBankAccount);

            return new ResponseEntity<>(myBankAccount,HttpStatus.OK);
        }catch (NumberFormatException numberFormatException) {
            return new ResponseEntity<>(HttpStatus.UNPROCESSABLE_ENTITY);
        }
    }
}
