package fr.fingarde.SpringBoot;

import org.springframework.boot.test.context.SpringBootTest;

@SpringBootTest
class ApplicationTests {

	/*@Test
	void bookSize1() {
		RestTemplate template = new RestTemplate();
		List<Book> result = template.getForObject("http://127.0.0.1:8080/book/", List.class);

		Assertions.assertEquals(1, result.size());
	}

	@Test
	void bookTitle() {
		RestTemplate template = new RestTemplate();
		List<Book> result = template.getForObject("http://127.0.0.1:8080/book/", List.class);

		Assertions.assertEquals("Cyril le gentil monsieur", result.get(0).getTitle());
	}*/

}
