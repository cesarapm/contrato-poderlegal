# 🎨 Guía de Estilos - Poder Legal

## 📋 Sistema de Diseño Premium Morado/Dorado

Este documento contiene todos los estilos, colores, tipografía y componentes del frontend de Poder Legal para mantener consistencia en el desarrollo Laravel.

---

## 🎨 Paleta de Colores

### Colores Principales

```css
/* Morados */
--primary-purple: #663399;
--purple-bishop: #4A148C;     /* Color principal de marca */
--purple-deep: #1A0933;       /* Morado más oscuro */
--light-purple: #9C27B0;
--dark-purple: #311B92;

/* Dorados */
--primary-gold: #FFD700;      /* Dorado principal */
--gold-accent: #FFC107;
--gold-warm: #FFAA00;

/* Neutros */
--primary-dark: #212121;
--white: #FFFFFF;
--bg-light: #FAFAFA;
--bg-medium: #F5F5F5;

/* Estados */
--success: #4CAF50;
--warning: #FF9800;
--error: #F44336;
```

### Gradientes

```css
/* Gradiente Morado */
--bg-gradient: linear-gradient(135deg, #4A148C 0%, #663399 50%, #9C27B0 100%);

/* Gradiente Dorado */
--gold-gradient: linear-gradient(135deg, #FFD700 0%, #FFC107 50%, #FFAA00 100%);

/* Gradiente Header Chat */
background: linear-gradient(135deg, #1A0933 0%, #4A148C 55%, #663399 100%);

/* Gradiente Mensaje Bot */
background: linear-gradient(135deg, #4A148C 0%, #663399 100%);
```

---

## 📝 Tipografía

### Fuentes

```css
/* Fuentes principales */
--font-display: 'Poppins', sans-serif;           /* Para títulos y destacados */
--font-primary: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;  /* Para texto general */

/* Importar en HTML */
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Inter:wght@300;400;500;600;700&display=swap');
```

### Jerarquía de Títulos

```css
h1 { font-size: 3.052em; font-weight: 700; }    /* ~48px */
h2 { font-size: 2.441em; font-weight: 700; }    /* ~39px */
h3 { font-size: 1.953em; font-weight: 700; }    /* ~31px */
h4 { font-size: 1.563em; font-weight: 700; }    /* ~25px */
h5 { font-size: 1.25em; font-weight: 700; }     /* ~20px */

/* Todos usan */
font-family: var(--font-display);
line-height: 1.2;
color: var(--primary-dark);
```

### Texto de Cuerpo

```css
body {
  font-family: var(--font-primary);
  font-size: 16px;
  line-height: 1.6;
  color: var(--primary-dark);
}
```

---

## 🔘 Botones

### Estilos Base

```css
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 12px 24px;
  border: none;
  border-radius: 25px;
  font-family: var(--font-primary);
  font-weight: 600;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 12px rgba(74, 20, 140, 0.12);
  min-width: 120px;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(74, 20, 140, 0.16);
}
```

### Variantes de Botones

```css
/* Botón Primario (Dorado) */
.btn-primary {
  background: linear-gradient(135deg, #FFD700 0%, #FFC107 50%, #FFAA00 100%);
  color: #212121;
}

.btn-primary:hover {
  background: linear-gradient(135deg, #FFAA00 0%, #FF8F00 100%);
  box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
}

/* Botón Secundario (Morado) */
.btn-secondary {
  background: linear-gradient(135deg, #4A148C 0%, #663399 50%, #9C27B0 100%);
  color: white;
}

.btn-secondary:hover {
  background: linear-gradient(135deg, #311B92 0%, #4A148C 100%);
  box-shadow: 0 8px 25px rgba(33, 33, 33, 0.4);
}

/* Botón Outline Primario */
.btn-outline-primary {
  background-color: transparent;
  color: #FFD700;
  border: 2px solid #FFD700;
}

.btn-outline-primary:hover {
  background-color: #FFD700;
  color: #212121;
}

/* Botón Outline Blanco */
.btn-outline-white {
  background-color: transparent;
  color: white;
  border: 2px solid rgba(255, 255, 255, 0.8);
}

.btn-outline-white:hover {
  background-color: #FFD700;
  border-color: #FFD700;
  color: #212121;
}
```

### Tamaños de Botones

```css
.btn-small {
  padding: 8px 16px;
  font-size: 14px;
  min-width: 100px;
}

.btn-large {
  padding: 16px 32px;
  font-size: 18px;
  min-width: 150px;
}

.btn-xl {
  padding: 20px 40px;
  font-size: 20px;
  min-width: 180px;
}

.btn-block {
  width: 100%;
}
```

---

## 📦 Espaciado y Layout

### Border Radius

```css
--border-radius-sm: 8px;
--border-radius-md: 16px;
--border-radius-lg: 24px;
--border-radius-xl: 32px;
--border-radius-hero: 40px;
```

### Sombras

```css
--shadow-sm: 0 2px 4px rgba(74, 20, 140, 0.08);
--shadow-md: 0 4px 12px rgba(74, 20, 140, 0.12);
--shadow-lg: 0 8px 24px rgba(74, 20, 140, 0.16);
--shadow-xl: 0 12px 32px rgba(74, 20, 140, 0.2);
--shadow-gold: 0 4px 20px rgba(255, 215, 0, 0.25);
```

### Efectos de Brillo

```css
--glow-purple: 0 0 40px rgba(156, 39, 176, 0.3);
--glow-gold: 0 0 30px rgba(255, 215, 0, 0.4);
```

---

## 🎬 Animaciones y Transiciones

### Transiciones

```css
--transition-fast: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
--transition-normal: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
--transition-slow: 0.6s cubic-bezier(0.4, 0, 0.2, 1);
--transition-bounce: 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
```

### Animaciones Clave

```css
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
}

@keyframes shimmer {
  0% { background-position: -200% 0; }
  100% { background-position: 200% 0; }
}

/* Uso */
.animate-fade-in {
  animation: fadeInUp 0.8s var(--transition-normal) forwards;
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}
```

---

## 📋 Formularios

### Inputs

```css
input, textarea {
  font-family: var(--font-primary);
  font-size: 14px;
  padding: 12px 18px;
  border: 1.5px solid #e4d4ff;
  border-radius: 28px;
  background: #ffffff;
  color: #1A0933;
  transition: all 0.2s;
}

input:focus, textarea:focus {
  border-color: #4A148C;
  outline: none;
  box-shadow: 0 0 0 3px rgba(74, 20, 140, 0.1);
}

input::placeholder, textarea::placeholder {
  color: rgba(146, 100, 214, 0.6);
  font-size: 14px;
}
```

### Labels

```css
label {
  font-family: var(--font-primary);
  font-weight: 600;
  font-size: 14px;
  color: #4A148C;
  margin-bottom: 8px;
  display: block;
}
```

### Estados de Validación

```css
/* Error */
.input-error {
  border-color: #F44336;
}

.error-message {
  color: #F44336;
  font-size: 12px;
  margin-top: 4px;
}

/* Success */
.input-success {
  border-color: #4CAF50;
}

/* Warning */
.input-warning {
  border-color: #FF9800;
}
```

---

## 📜 Scrollbar Personalizado

```css
/* Scrollbar Principal */
::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: #1A0933;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(180deg, #FFD700 0%, #FFC107 100%);
  border-radius: 6px;
  border: 2px solid #1A0933;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(180deg, #FFC107 0%, #FFAA00 100%);
}

/* Firefox */
* {
  scrollbar-width: thick;
  scrollbar-color: #FFD700 #1A0933;
}
```

---

## 🎴 Cards y Contenedores

### Card Base

```css
.card {
  background: #ffffff;
  border-radius: 24px;
  padding: 32px;
  box-shadow: 0 8px 24px rgba(74, 20, 140, 0.12);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(74, 20, 140, 0.2);
}
```

### Card con Gradiente

```css
.card-gradient {
  background: linear-gradient(135deg, #4A148C 0%, #663399 100%);
  color: white;
}
```

---

## 💬 Componente de Mensaje/Notificación

### Mensajes del Sistema

```css
.message-bot {
  background: linear-gradient(135deg, #4A148C 0%, #663399 100%);
  color: #ffffff;
  padding: 11px 16px;
  border-radius: 4px 20px 20px 20px;
  box-shadow: 0 2px 12px rgba(74, 20, 140, 0.2);
  font-size: 0.9rem;
  line-height: 1.55;
}

.message-user {
  background: #FFD700;
  color: #1A0933;
  padding: 11px 16px;
  border-radius: 20px 4px 20px 20px;
  box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
  font-size: 0.9rem;
  line-height: 1.55;
}
```

---

## 📱 Responsive

### Breakpoints

```css
/* Mobile */
@media (max-width: 768px) {
  h1 { font-size: 2.5rem; }
  h2 { font-size: 2rem; }
  h3 { font-size: 1.5rem; }
  body { font-size: 16px; }
  
  .btn {
    padding: 10px 20px;
    font-size: 14px;
    min-width: 100px;
  }
}

/* Tablet */
@media (max-width: 1024px) {
  /* Ajustes para tablet */
}

/* Desktop */
@media (min-width: 1025px) {
  /* Estilos desktop */
}
```

---

## 🎯 Estados de Focus y Accesibilidad

```css
/* Focus visible */
*:focus {
  outline: 2px solid #FFD700;
  outline-offset: 2px;
}

/* Selección de texto */
::selection {
  background: #FFD700;
  color: #212121;
}

::-moz-selection {
  background: #FFD700;
  color: #212121;
}

/* Screen reader only */
.sr-only {
  position: absolute !important;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  white-space: nowrap;
  border-width: 0;
}
```

---

## 🎨 Clases de Utilidad

### Texto con Gradiente

```css
.text-gradient-primary {
  background: linear-gradient(135deg, #FFD700, #FFC107);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.text-gradient-purple {
  background: linear-gradient(135deg, #4A148C, #9C27B0);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
```

### Fondos

```css
.bg-gradient-primary {
  background: linear-gradient(135deg, #FFD700 0%, #FFC107 50%, #FFAA00 100%);
}

.bg-gradient-secondary {
  background: linear-gradient(135deg, #4A148C 0%, #663399 50%, #9C27B0 100%);
}

.bg-light {
  background: #f9f6ff;
}
```

---

**Última actualización:** Mayo 2026  
**Versión:** 1.0  
**Contacto:** Poder Legal - contacto@poderlegal.mx
