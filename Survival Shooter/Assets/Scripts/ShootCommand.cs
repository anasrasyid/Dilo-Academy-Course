public class ShootCommand : Command
{
    PlayerShooting playerShooting;

    public ShootCommand(PlayerShooting playerShooting)
    {
        this.playerShooting = playerShooting;
    }

    public override void Excute()
    {
        this.playerShooting.Shoot();
    }

    public override void UnExecute()
    {

    }
}
