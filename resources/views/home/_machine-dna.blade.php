<section class="machine-dna">
    <div class="dna-header">
        <h2>Machine DNA</h2>
        <p>Precision engineered. Emotion driven.</p>
    </div>

    <div class="dna-grid">
        <div class="dna-card">
            <div class="dna-inner">
                <h3>VX-01</h3>
                <span class="tag">Velocity Core</span>

                <div class="specs">
                    <p>Power: 980 HP</p>
                    <p>0-100: 2.1s</p>
                    <p>Weight: 740kg</p>
                </div>

                <div class="philosophy">
                    Built for dominance.
                </div>
            </div>
        </div>

        <div class="dna-card">
            <div class="dna-inner">
                <h3>AERO-X</h3>
                <span class="tag">Aero Precision</span>

                <div class="specs">
                    <p>Power: 920 HP</p>
                    <p>0-100: 2.4s</p>
                    <p>Weight: 710kg</p>
                </div>

                <div class="philosophy">
                    Air is your weapon.
                </div>
            </div>
        </div>

        <div class="dna-card">
            <div class="dna-inner">
                <h3>NR-77</h3>
                <span class="tag">Neural Response</span>

                <div class="specs">
                    <p>Power: 1000 HP</p>
                    <p>0-100: 1.9s</p>
                    <p>Weight: 730kg</p>
                </div>

                <div class="philosophy">
                    React before thought.
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.machine-dna {
    background: #0a0a0a;
    color: white;
    padding: 120px 10%;
    overflow: hidden;
}

.dna-header {
    text-align: center;
    margin-bottom: 80px;
}

.dna-header h2 {
    font-size: 64px;
    letter-spacing: 2px;
}

.dna-header p {
    opacity: 0.6;
    margin-top: 10px;
}

.dna-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.dna-card {
    position: relative;
    height: 400px;
    border: 1px solid rgba(255,255,255,0.1);
    overflow: hidden;
    cursor: pointer;
}

.dna-inner {
    padding: 30px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: 0.4s;
}

.dna-card:hover .dna-inner {
    transform: translateY(-10px);
}

.tag {
    font-size: 12px;
    opacity: 0.5;
}

.specs p {
    margin: 5px 0;
    opacity: 0.8;
}

.philosophy {
    font-size: 14px;
    opacity: 0;
    transform: translateY(20px);
    transition: 0.4s;
}

.dna-card:hover .philosophy {
    opacity: 1;
    transform: translateY(0);
}

/* Glow effect */
.dna-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at center, rgba(255,255,255,0.08), transparent);
    opacity: 0;
    transition: 0.4s;
}

.dna-card:hover::before {
    opacity: 1;
}
</style>