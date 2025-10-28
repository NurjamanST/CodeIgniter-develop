document.addEventListener("DOMContentLoaded", function () {
	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add("visible");
				}
			});
		},
		{ threshold: 0.3 }
	);

	document.querySelectorAll(".fade-up").forEach((el) => observer.observe(el));
});
