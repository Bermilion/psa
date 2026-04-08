// scripts/generate-colors.js
import { execSync } from 'child_process';
import path from 'path';

/**
 * Плагин для Vite, который генерирует JSON с цветами из CSS переменных
 * @returns {import('vite').Plugin}
 */
export default function generateColorsPlugin() {
    const generateColors = () => {
        console.log('🎨 Генерация JSON массива цветов на основе CSS...');

        try {
            // Запускаем PHP скрипт
            execSync('php scripts/generate-color-array.php', {
                stdio: 'inherit',
                cwd: process.cwd()
            });
            return true;
        } catch (error) {
            console.error('❌ Ошибка генерации массива цветов:', error.message);
            return false;
        }
    };

    return {
        name: 'generate-colors-on-change',

        // Генерируем при запуске Vite
        buildStart() {
            generateColors();
        },

        // Следим за изменениями в CSS файле
        handleHotUpdate({ file, server }) {
            if (file.includes('app.css') || file.includes('resources/css/')) {
                if (generateColors()) {
                    // Отправляем событие в браузер для обновления
                    server.ws.send({
                        type: 'full-reload',
                        path: '*'
                    });
                }
            }
        },

        // Также генерируем перед сборкой
        buildEnd() {
            generateColors();
        }
    };
}
