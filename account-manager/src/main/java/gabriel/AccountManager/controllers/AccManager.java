package gabriel.AccountManager.controllers;

import gabriel.AccountManager.Utils;
import gabriel.AccountManager.model.BankAccount;
import gabriel.AccountManager.services.AccService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/acc")
public class AccManager {

    @Autowired
    private AccService service;

    @GetMapping("")
    public ResponseEntity<List<BankAccount>> getAccounts() {
        try {

            List<BankAccount> banksAccount = service.getBankAccounts();

            return new ResponseEntity<>(banksAccount,HttpStatus.OK);

        }catch (Exception e){
            return new ResponseEntity<>(new ArrayList<>(),HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PostMapping("")
    @ResponseBody
    public ResponseEntity<BankAccount> postBank(@RequestBody BankAccount bankAccount) {
        try {

            if (!Utils.isModelValid(bankAccount)) {
                return new ResponseEntity<>(HttpStatus.UNPROCESSABLE_ENTITY);
            }

            service.addBankAccount(bankAccount);

            return new ResponseEntity<>(bankAccount,HttpStatus.CREATED);

        }catch (Exception e){
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    public ResponseEntity<String> delete(Long id) {
        try {

            boolean hasBeenDeleted = service.deleteBankAccount(id);

            if (hasBeenDeleted) {
                return new ResponseEntity<>(" Id \"" + id.toString() + "\" Successfully deleted",HttpStatus.NO_CONTENT);
            }

            return new ResponseEntity<>("Id \"" + id.toString() + "\" Not found",HttpStatus.NOT_FOUND);

        }catch (Exception e){
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @DeleteMapping(value = "/{name}")
    public ResponseEntity<String> delete(@PathVariable("name") String name){
        try{

            Long parseLong = Long.parseLong(name);
            return delete(parseLong);

        }catch (NumberFormatException numberFormatException){
            boolean hasBeenDeleted = service.deleteBankAccount(name);
            if (hasBeenDeleted) {
                return new ResponseEntity<>("bankAccount appartenant à \"" + name + "\" Successfully deleted",HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>("bankAccount appartenant à \"" + name + "\" Not found",HttpStatus.NOT_FOUND);
        }
    }

    private ResponseEntity<BankAccount> getAccountByName(String name) {
        try {
            Optional<BankAccount> bankAccountOptional = service.searchFirstByName(name);
            return bankAccountOptional.map(bankAccount -> new ResponseEntity<>(bankAccount, HttpStatus.OK)).orElseGet(() -> new ResponseEntity<>(HttpStatus.NOT_FOUND));
        }catch (Exception e){
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @GetMapping("{value}")
    public ResponseEntity<BankAccount> get(@PathVariable("value") String value)
    {
        try{

            Long parseLong = Long.parseLong(value);

            Optional<BankAccount> bankAccountOptional = service.getById(parseLong);

            if (bankAccountOptional.isEmpty()){
                return new ResponseEntity<>(HttpStatus.NOT_FOUND);
            }
            
            return new ResponseEntity<>(bankAccountOptional.get(),HttpStatus.OK);
        }catch (NumberFormatException numberFormatException){
            return getAccountByName(value);
        }
    }
}
