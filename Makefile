build:
	@docker build -t tester .

test:
	@docker run --rm -v $(CURDIR):/app tester $(FLAGS)
