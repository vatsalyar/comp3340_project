/*
 * Author: Vatsalya Rastogi (110147846)
 * Course: COMP3340
 * Description: Client-side interactivity, DOM manipulation, and dynamic API fetching.
 */

"use strict";

// Runs once page content is ready.
document.addEventListener("DOMContentLoaded", () => {
  setupThemeSwitcher();
  setupContactForm();
  setupCurrencyConverter();
  loadWindsorWeather();
});

// Theme switcher: swaps body class to light-theme / dark-theme / blue-theme.
function setupThemeSwitcher() {
  const themeSelect = document.getElementById("themeSelect");
  if (!themeSelect) return;
  const validThemes = ["light-theme", "dark-theme", "blue-theme"];

  // Restore previously selected theme, if available.
  const savedTheme = localStorage.getItem("siteTheme");
  if (savedTheme && validThemes.includes(savedTheme)) {
    document.body.className = savedTheme;
    themeSelect.value = savedTheme;
  }

  themeSelect.addEventListener("change", (e) => {
    const nextTheme = e.target.value;
    if (!validThemes.includes(nextTheme)) return;
    document.body.className = nextTheme;
    localStorage.setItem("siteTheme", nextTheme);
  });
}

// Basic contact form (frontend placeholder only).
function setupContactForm() {
  const form = document.getElementById("contactForm");
  const result = document.getElementById("contactResult");
  if (!form || !result) return;

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    result.textContent = "Thank you. Your message has been received, and our team will get back to you shortly.";
    form.reset();
  });
}

// API 1 + Form: Convert USD to CAD with open.er-api.com.
function setupCurrencyConverter() {
  const form = document.getElementById("currencyForm");
  const input = document.getElementById("usdAmount");
  const output = document.getElementById("currencyResult");
  if (!form || !input || !output) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const usd = Number(input.value);
    if (Number.isNaN(usd) || usd < 0) {
      output.textContent = "Enter a valid USD amount.";
      return;
    }

    try {
      const res = await fetch("https://open.er-api.com/v6/latest/USD");
      const data = await res.json();
      const rate = data?.rates?.CAD;

      if (!rate) {
        output.textContent = "Rate unavailable right now.";
        return;
      }

      const cad = usd * rate;
      output.textContent = `USD $${usd.toFixed(2)} = CAD $${cad.toFixed(2)}`;
    } catch (err) {
      output.textContent = "Currency API request failed.";
    }
  });
}

// API 2: Windsor weather text in footer using open-meteo (no key required).
async function loadWindsorWeather() {
  const weatherText = document.getElementById("weatherText");
  if (!weatherText) return;

  try {
    // Windsor, Ontario coordinates.
    const url =
      "https://api.open-meteo.com/v1/forecast?latitude=42.3149&longitude=-83.0364&current=temperature_2m&temperature_unit=celsius";
    const res = await fetch(url);
    const data = await res.json();

    const temp = data?.current?.temperature_2m;
    if (typeof temp === "number") {
      weatherText.textContent = `Current Windsor Weather: ${temp}°C`;
    } else {
      weatherText.textContent = "Current Windsor Weather: unavailable";
    }
  } catch (err) {
    weatherText.textContent = "Current Windsor Weather: unavailable";
  }
}
