public class MoveCommand : Command
{
    PlayerMovement playerMovement;
    float h, v;

    public MoveCommand(PlayerMovement playerMovement, float h, float v)
    {
        this.playerMovement = playerMovement;
        this.h = h;
        this.v = v;
    }

    public override void Excute()
    {
        playerMovement.Move(this.h, this.v);
        playerMovement.Animating(this.h, this.v);
    }

    public override void UnExecute()
    {
        playerMovement.Move(-h, -v);
        playerMovement.Animating(this.h, this.v);
    }
}
